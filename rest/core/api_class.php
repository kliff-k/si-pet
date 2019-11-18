<?php

class API
{
    /**
     * Objeto PDO, utilizada em vários métodos da api.
     * @access protected
     * @var object
     * @name $bd
     */
    protected $bd;

    /**
     * String com o método da requisição (GET, PUT, POST, PATCH, DELETE, OPTIONS)
     * @access private
     * @var string
     * @name $method
     */
    private $method;

    /**
     * String com a fonte a ser consultada.
     * @access private
     * @var string
     * @name $source
     */
    private $source;

    /**
     * Array com os fragmentos do caminho.
     * @access private
     * @var array
     * @name $path
     */
    private $path;

    /**
     * String com o endpoint chamado.
     * @access private
     * @var string
     * @name $endpoint
     */
    private $endpoint;

    /**
     * String com o tipo de auth no header AUTHORIZATION ({auth} TOKEN).
     * @access private
     * @var string
     * @name $auth
     */
    private $auth;

    /**
     * Integer com o id do usuário requisitante (Quando a chamada possui algum tipo de autenticação)
     * @access private
     * @var int
     * @name $user
     */
    private $user;

    /**
     * String com o token no header AUTHORIZATION (AUTH {token}).
     * @access private
     * @var string
     * @name $auth
     */
    private $token;

    /**
     * String com a chave de acesso no header AUTHORIZATION ({access_key}:{signature}).
     * @access private
     * @var string
     * @name $auth
     */
    private $key;

    /**
     * String com a assinatura no header AUTHORIZATION ({access_key}:{signature}).
     * @access private
     * @var string
     * @name $auth
     */
    private $sig;

    /**
     * String com a timestamp vindo do header DATE.
     * @access private
     * @var string
     * @name $date
     */
    private $date;

    /**
     * Array proveniente do JSON no corpo da requisição, contém os dados para requisições POST/PUT/PATCH.
     * @access private
     * @var array
     * @name $data
     */
    private $data;

    /**
     * SRA constructor.
     * O construtor da classe se encarrega de:
     * 1. Capturar todas as informações da requisição feita à API:
     *    method: GET,PUT, POST, PATCH, DELETE (Request).
     *    path: /caminho/da/requisicao (URI).
     *    auth: chave_do_usuario:assinatura_do_usuario (http header).
     *    date: data_de_requisicao (http header).
     *    data: dados do corpo da requisição (json).
     * 2. Instanciar o objeto PDO (Que gerenciará o acesso e todas a requisições aos BDs da SAGI).
     * 3. Executar a chamada.
     */
    public function __construct ()
    {
        // Inicia a sessão
        session_start();

        // Captura todas as variáveis necessárias.
        $this->method   = $_SERVER['REQUEST_METHOD'];
        $this->date     = $_SERVER["HTTP_DATE"];
        $this->data     = json_decode(file_get_contents('php://input'),true);
        $this->auth     = explode(' ',$_SERVER["HTTP_AUTHORIZATION"])[0];
        $this->token    = explode(' ',$_SERVER["HTTP_AUTHORIZATION"])[1];
        $this->key      = explode(':',$this->token)[0];
        $this->sig      = explode(':',$this->token)[1];
        $this->source   = explode('/',$_SERVER['REQUEST_URI'])[3];
        $this->path     = array_slice(explode('/',explode('?',$_SERVER['REQUEST_URI'])[0]),3);
        $this->endpoint = '/'.implode('/',$this->path);

        // Executa a chamada à fonte requisitada.
        $this->execSource();
    }

    /**
     * Destructor.
     * Fecha a conexão com o banco.
     */
    public function __destruct()
    {
        unset($this->bd);
    }

    /**
     * Executa a chamada referente à fonte requisitada no PATH.
     * @access private
     */
    private function execSource ()
    {
        $return = '';
        $return_type = 'application/json';
        // Endpoints
        switch ($this->path[1])
        {
            case 'login':
                if(!$this->data['id'])
                    break;

                switch ($this->method)
                {
                    case 'POST':
                        $_SESSION['si-pet-id'] = $this->data['id'];

                        $return = ['sucesso'];
                        break;
                }
                break;
            case 'logout':
                switch ($this->method)
                {
                    case 'DELETE':
                        session_destroy();

                        $return = ['sucesso'];
                        break;
                }
                break;
            case 'history':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../data/log.json'), TRUE)[$_SESSION['si-pet-id']]);
                        break;
                }
                break;
            case 'alimentacao':
                switch ($this->path[2])
                {
                    case 'deploy':
                        switch ($this->method)
                        {
                            case 'POST':

                                $file = json_decode(file_get_contents('../../external/food.json'), TRUE);

                                if($file[$_SESSION['si-pet-id']]['reservatorio'] < 20)
                                {
                                    $return = ['Reservatório vazio'];
                                    break;
                                }

                                $file[$_SESSION['si-pet-id']]['tigela'] = $file[$_SESSION['si-pet-id']]['tigela'] + 20;
                                $file[$_SESSION['si-pet-id']]['reservatorio'] = $file[$_SESSION['si-pet-id']]['reservatorio'] - 20;
                                file_put_contents('../../external/food.json', json_encode($file));

                                $file = json_decode(file_get_contents('../../data/log.json'), TRUE);
                                $file[$_SESSION['si-pet-id']]['alimentacao'][] = ['tipo' => 'manual', 'horario' => date('d/m/Y')];
                                file_put_contents('../../data/log.json', json_encode($file));

                                $return = ['Porção de alimento liberada'];
                                break;
                        }
                        break;
                    case 'schedule':
                        switch ($this->method)
                        {
                            case 'POST':
                                $file = json_decode(file_get_contents('../../data/schedule.json'), TRUE);
                                $file[$_SESSION['si-pet-id']][rand()] = ['quantidade' => $this->data['quantidade'], 'horario' => $this->data['horario']];
                                file_put_contents('../../data/schedule.json', json_encode($file));
                                $return = ['Refeição agendada'];
                                break;
                            case 'GET':
                                $array = json_decode(file_get_contents('../../data/schedule.json'), TRUE)[$_SESSION['si-pet-id']];
                                foreach ($array AS $key => $value)
                                    $return .= "<tr class='text-center'><td>".$value['horario']."</td><td>".$value['quantidade']."</td><td><button type='button' onclick='removeSchedule(".$key.")'><i class='fa fa-times fa-2x'></button></i></td></tr>";
                                $return_type = 'application/html';
                                break;
                            case 'DELETE':
                                $file = json_decode(file_get_contents('../../data/schedule.json'), TRUE)[$_SESSION['si-pet-id']];
                                unset($file[$this->data['id']]);
                                file_put_contents('../../data/schedule.json', json_encode($file));
                                $return = ['Agendamento removido.'];
                                break;
                        }
                        break;
                }
                break;
            case 'photo':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../data/photos.json'), TRUE)[$_SESSION['si-pet-id']][$this->path[2]]);
                        break;
                    case 'POST':
                        $file = json_decode(file_get_contents('../../data/photos.json'), TRUE);
                        $file[$_SESSION['si-pet-id']][] = ['id' => rand(), 'horario' => date('d/m/Y')];
                        file_put_contents('../../data/photos.json', json_encode($file));

                        $return = ['Foto adicionada à galeria'];
                        break;
                    case 'DELETE':
                        $file = json_decode(file_get_contents('../../data/photos.json'), TRUE);
                        foreach (json_decode($this->data['photos'], TRUE) AS $chave)
                            unset($file[$_SESSION['si-pet-id']][$chave]);
                        file_put_contents('../../data/photos.json', json_encode($file));

                        $return = ['sucesso'];
                        break;
                }
                break;
            case 'gallery':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../data/photos.json'), TRUE)[$_SESSION['si-pet-id']]);
                        break;
                }
                break;
            case 'pet':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../data/pet.json'), TRUE)[$_SESSION['si-pet-id']]);
                        break;
                    case 'POST':
                        $file = json_decode(file_get_contents('../../data/pet.json'), TRUE);
                        $file[$_SESSION['si-pet-id']][] = ['id' => rand(), 'nome' => $this->data['nome'], 'especie' => $this->data['especie'], 'peso' => $this->data['peso']];
                        file_put_contents('../../data/pet.json', json_encode($file));

                        $return = ['sucesso'];
                        break;
                    case 'DELETE':
                        $file = json_decode(file_get_contents('../../data/pet.json'), TRUE);
                        unset($file[$_SESSION['si-pet-id']][$this->data['pet']]);
                        file_put_contents('../../data/pet.json', json_encode($file));

                        $return = ['sucesso'];
                        break;
                }
                break;
            case 'food':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../external/food.json'), TRUE)[$_SESSION['si-pet-id']]);
                        break;
                    case 'POST':
                        $file = json_decode(file_get_contents('../../external/food.json'), TRUE);
                        $file[$_SESSION['si-pet-id']]['reservatorio'] = $file[$_SESSION['si-pet-id']]['reservatorio'] + 100;
                        file_put_contents('../../external/food.json', json_encode($file));
                        $return = ['100g adicionadas ao reservatório primário.'];
                        break;
                }
                break;
            case 'environment':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../external/environment.json'), TRUE)[$_SESSION['si-pet-id']]);
                        break;
                }
                break;
            case 'door':
                switch ($this->method)
                {
                    case 'GET':
                        $return = json_encode(json_decode(file_get_contents('../../external/door.json'), TRUE)[$_SESSION['si-pet-id']]);
                        break;
                }
                break;
        }

        if(!$return)
            $this->endExec(400,['Método inadequado']);

        $this->endExec(200,$return, $return_type);
    }

    /**
     * Método para finalizar a execução da API e retornar o HTTP Response Code devido, junto com o resultado da consulta, se necessário.
     *
     * @param int $code
     * @param string $content
     * @param string $content_type
     * @param string $log
     */
    private function endExec ($code = 400, $content = "", $content_type = "application/json", $log = "")
    {

        // Fecha a conexão com o banco.
        unset($this->bd);

        // Calcula um hash para o conteúdo (Se existir).
        if($content)
            $etag = md5(serialize($content));
        else
            $etag = FALSE;

        // Verifica se essa página já foi servida para o cliente
        if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && $etag)
        {
            if (str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag)
            {
                http_response_code('304');
                exit;
            }
        }

        // Prepara o conteúdo a ser retornado de acordo com o tipo.
        switch($content_type)
        {
            case 'application/pdf':
                header('Content-Description: File Transfer');
                header('Content-Disposition: attachment; filename=arquivo.pdf');
                break;
            case 'application/json':
                $content = $content?json_encode($content):"";
                break;
        }
        header("Content-Type: $content_type");
        if($etag)
            header("Etag: $etag");

        // Retorna o HTTP Response Code e o conteúdo (Se necessário)
        http_response_code($code);
        echo $content;

        exit;
    }
}
