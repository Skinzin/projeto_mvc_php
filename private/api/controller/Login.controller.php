<?php 
    #[AllowDynamicProperties] /* Sinalizando ao PHP para não emitir avisos DEPRECATED ao definir uma propriedade dinâmica (8.2x). */
    class Login {
        private $userName;
        private $userEmail;
        private $userPassword;
        private $userHash;
        private $userStatus;
        // public $fxLogin;

        public function setUsername(string $userName) : string {
            return $this->userName = $userName;
        }
        public function getUsername(string $userName) : string {
            return $this->userName;
        }

        public function setEmail(string $userEmail) : string {
            return $this->userEmail = $userEmail;
        }
        public function getEmail(string $userEmail) : string {
            return $this->userEmail;
        }

        public function setPassword(string $userPassword, string $userEmail) : string {
            $senhaMd5 = (md5($userPassword));
            $loginMD5 = (md5($userEmail));
            $apiKeyMD5 = (md5('p4ri0e'));

            $passCrypt = (md5($apiKeyMD5.$senhaMd5.$loginMD5));
            $passUser = $userEmail;
            $custo = '09';
            $salt = $passCrypt;

            $cryptoPass = crypt($passUser, "$2b$".$custo."$".$salt.'$');

            return $this->userPassword = $cryptoPass;
        }
        public function getPassword(string $userPassword) : string {
            return $this->userPassword;
        }

        public function setUserHash(string $userPassword, string $userEmail) : string {
            $senhaHMD5 = (md5($userPassword));
            $emailHMD5 = (md5($userEmail));
            $apiKeyHMD5 = (md5('l4g1n_iop0'));
            
            $hashPass = (md5($senhaHMD5.$emailHMD5.$apiKeyHMD5));
            $cryptoHash = crypt($senhaHMD5, "$2b$".'08'."$".$hashPass."$");

            return $this->userHash = $cryptoHash;
        }
        public function getUserHash(string $userPassword, string $userEmail) : string {
            return $this->userHash;
        }

        function setAddLogin(string $fxLogin) {
            require("../../db/conn.php");

            $query = mysqli_query($conn, "SELECT username, email FROM `LOGIN` WHERE  username = '$this->userName' OR email='$this->userEmail'");
            $emailDB = "";
            $usernameDB = "";

            if($result = $query) {
                while($row = mysqli_fetch_row($result)) {
                    $usernameDB = $row[1];
                    $emailDB = $row[0];
                }

                mysqli_free_result($result);
            }

            if(($emailDB === $this->userEmail) || ($usernameDB == $this->userName)) {
                $retorna = [
                    'status' => false,
                    'userName' => $this->userName,
                    'userEmail' => $this->userEmail,
                    'msg' => '<p style="color:#f00">ERRO - Usuário já cadastrado!</p>'
                ];
            } else {
                $query = mysqli_query($conn, "INSERT INTO `LOGIN` (email, username, senha, `hash`, `status`) VALUES('$this->userEmail', '$this->userName', '$this->userPassword', '$this->userHash', 1)");

                if($query) {
                    $retorna = [
                        'status' => true,
                        'userName' => $this->userName,
                        'userEmail' => $this->userEmail,
                        'msg' => '<p style="color:#0f0">Usuario cadastrado com sucesso!</p>'
                    ];
                } else {
                    $retorna = [
                        'status' => false,
                        'userName' => $this->userName,
                        'userEmail' => $this->userEmail,
                        'msg' => '<p style="color:#f00">ERRO - Usuário não cadastrado!</p>'
                    ];
                }
            }

            $conn->close();

            return $this->fxLogin = $retorna;
        }

        /* public function setStatus(string $) {}
        public function getStatus(string $) {}

        public function setAddLogin(string $) {}
        public function getAddLogin(string $) {} */
    };
?>