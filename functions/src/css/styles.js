module.exports = { style: '@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";' +
    'body {' +
    '    font-family: \'Poppins\', sans-serif;' +
    '    background: #fafafa;' +
    '}' +
    'p {' +
    '    font-family: \'Poppins\', sans-serif;' +
    '    font-size: 1.1em;' +
    '    font-weight: 300;' +
    '    line-height: 1.7em;' +
    '    color: #999;' +
    '}' +
    'a, a:hover, a:focus {' +
    '    color: inherit;' +
    '    text-decoration: none;' +
    '    transition: all 0.3s;' +
    '}' +
    '.navbar {' +
    '    padding: 15px 10px;' +
    '    background: #fff;' +
    '    border: none;' +
    '    border-radius: 0;' +
    '    margin-bottom: 40px;' +
    '    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);' +
    '}' +
    '.navbar-btn {' +
    '    box-shadow: none;' +
    '    outline: none !important;' +
    '    border: none;' +
    '}' +
    '.line {' +
    '    width: 100%;' +
    '    height: 1px;' +
    '    border-bottom: 1px dashed #ddd;' +
    '    margin: 40px 0;' +
    '}' +
    '/* ---------------------------------------------------' +
    '    SIDEBAR STYLE' +
    '----------------------------------------------------- */' +
    '#sidebar {' +
    '    width: 250px;' +
    '    position: fixed;' +
    '    top: 0;' +
    '    left: -250px;' +
    '    height: 100vh;' +
    '    z-index: 999;' +
    '    background: #7386D5;' +
    '    color: #fff;' +
    '    transition: all 0.3s;' +
    '    overflow-y: scroll;' +
    '    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);' +
    '}' +
    '#sidebar.active {' +
    '    left: 0;' +
    '}' +
    '#dismiss {' +
    '    width: 35px;' +
    '    height: 35px;' +
    '    line-height: 35px;' +
    '    text-align: center;' +
    '    background: #7386D5;' +
    '    position: absolute;' +
    '    top: 10px;' +
    '    right: 10px;' +
    '    cursor: pointer;' +
    '    -webkit-transition: all 0.3s;' +
    '    -o-transition: all 0.3s;' +
    '    transition: all 0.3s;' +
    '}' +
    '#dismiss:hover {' +
    '    background: #fff;' +
    '    color: #7386D5;' +
    '}' +
    '.overlay {' +
    '    position: fixed;' +
    '    width: 100vw;' +
    '    height: 100vh;' +
    '    background: rgba(0, 0, 0, 0.7);' +
    '    z-index: 998;' +
    '    display: none;' +
    '}' +
    '#sidebar .sidebar-header {' +
    '    padding: 20px;' +
    '    background: #6d7fcc;' +
    '}' +
    '#sidebar ul.components {' +
    '    padding: 20px 0;' +
    '    border-bottom: 1px solid #47748b;' +
    '}' +
    '#sidebar ul p {' +
    '    color: #fff;' +
    '    padding: 10px;' +
    '}' +
    '#sidebar ul li a {' +
    '    padding: 10px;' +
    '    font-size: 1.1em;' +
    '    display: block;' +
    '}' +
    '#sidebar ul li a:hover {' +
    '    color: #7386D5;' +
    '    background: #fff;' +
    '}' +
    '#sidebar ul li.active > a, a[aria-expanded="true"] {' +
    '    color: #fff;' +
    '    background: #6d7fcc;' +
    '}' +
    'a[data-toggle="collapse"] {' +
    '    position: relative;' +
    '}' +
    'a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {' +
    '    content: \'\\e259\';' +
    '    display: block;' +
    '    position: absolute;' +
    '    right: 20px;' +
    '    font-family: \'Glyphicons Halflings\';' +
    '    font-size: 0.6em;' +
    '}' +
    'a[aria-expanded="true"]::before {' +
    '    content: \'\\e260\';' +
    '}' +
    'ul ul a {' +
    '    font-size: 0.9em !important;' +
    '    padding-left: 30px !important;' +
    '    background: #6d7fcc;' +
    '}' +
    'ul.CTAs {' +
    '    padding: 20px;' +
    '}' +
    'ul.CTAs a {' +
    '    text-align: center;' +
    '    font-size: 0.9em !important;' +
    '    display: block;' +
    '    border-radius: 5px;' +
    '    margin-bottom: 5px;' +
    '}' +
    'a.download {' +
    '    background: #fff;' +
    '    color: #7386D5;' +
    '}' +
    'a.article, a.article:hover {' +
    '    background: #6d7fcc !important;' +
    '    color: #fff !important;' +
    '}' +
    '/* ---------------------------------------------------' +
    '    CONTENT STYLE' +
    '----------------------------------------------------- */' +
    '#content {' +
    '    width: 100%;' +
    '    padding: 20px;' +
    '    min-height: 100vh;' +
    '    transition: all 0.3s;' +
    '    position: absolute;' +
    '    top: 0;' +
    '    right: 0;' +
    '}' };