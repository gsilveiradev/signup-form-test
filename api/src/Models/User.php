<?php

namespace SignupFormTest\Models;

/**
 * @Entity @Table(name="users")
 **/
class User
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /** @Column(type="string") **/
    protected $email;
    
    /** @Column(type="string") **/
    protected $password;

    /** @Column(type="string") **/
    protected $nome;

    /** @Column(type="string", nullable=true) **/
    protected $apelido;

    /** @Column(type="string", nullable=true) **/
    protected $endereco;

    /** @Column(type="string", name="cod_postal", nullable=true) **/
    protected $cod_postal;

    /** @Column(type="string", nullable=true) **/
    protected $localidade;

    /** @Column(type="string", nullable=true) **/
    protected $pais;

    /** @Column(type="string", nullable=true) **/
    protected $nif;

    /** @Column(type="string", nullable=true) **/
    protected $telefone;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getApelido()
    {
        return $this->apelido;
    }

    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getCodPostal()
    {
        return $this->cod_postal;
    }

    public function setCodPostal($cod_postal)
    {
        $this->cod_postal = $cod_postal;
    }

    public function getLocalidade()
    {
        return $this->localidade;
    }

    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function getNif()
    {
        return $this->nif;
    }

    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
}
