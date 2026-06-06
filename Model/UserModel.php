<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $cpf, $data_nasc, $senha, $role = 'usuario') {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, cpf, data_nascimento, senha, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $cpf, $data_nasc, $hash, $role]);
    }

    public function buscarPorCpf($cpf) {
        $sql = "SELECT * FROM usuarios WHERE cpf = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSenha($cpf, $data_nasc, $nova_senha) {
        $sqlCheck = "SELECT id FROM usuarios WHERE cpf = ? AND data_nascimento = ?";
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([$cpf, $data_nasc]);
        
        if ($stmtCheck->fetch()) {
            $hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sqlUpdate = "UPDATE usuarios SET senha = ? WHERE cpf = ?";
            $stmtUpdate = $this->pdo->prepare($sqlUpdate);
            return $stmtUpdate->execute([$hash, $cpf]);
        }
        return false;
    }
}
?>