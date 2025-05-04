    <?php
    // PASSWORD TO BE CHANGED IN PRODUCTION
    $adminPassword = "FUNDADASDAFUGAacalajkfgladgc";
    class User {
        public $username;
        public $isRdev = false;
        public $adminPassword = "rdev";
        public function __construct($username) {
            $this->username = $username;
        }

        public function __wakeup() {
            global $adminPassword;
            if ($this->isRdev){
                $adminPassword = $this->adminPassword;
            }
        }
    }
    if (isset($_COOKIE['rdev'])) {
        $data = $_COOKIE['rdev'];
        $data = base64_decode($data);
        $user = unserialize($data);
    }

    if (isset($_GET['password']) && $_GET['password'] === $adminPassword) {
        echo "Welcome rdev! Here is your flag: <br> <code>rvctf{you_should_join_rdev}</code>";
    }
    else{
        echo "bohoohoo. I wonder what .phps means?";
    }


