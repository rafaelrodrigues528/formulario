<?php

class Application_Model_Db extends Zend_Db_Table_Abstract {

    protected $_name = 'lab';
    protected $_primary = 'idLab';

    /*
     * Função que insere dados na tabela
     */

    public function insereDados($data) {

        // Insere os dados do array '$data' no banco de dados.
        // Caso não seja possível inserir no banco de dados retorna falso.
        try {

            $this->insert($data);

            return true;
        } catch (Zend_Db_Exception $e) {

            echo $e;
            return false;
        }
    }

    public function selectDados($lab) {
        try {

            $select = $this->select()->from('lab')->where("nomeLaboratorio LIKE '%$lab%' or idLab='$lab' or local='$lab' or data='$lab'")->setIntegrityCheck(false);


            $result = $this->fetchAll($select);

            return $result;
        } catch (Zend_Db_Exception $e) {

            echo $e;
            return false;
        }
    }

    public function selectAllDados() {
        try {

            $select = $this->select()->setIntegrityCheck(false);


            $result = $this->fetchAll($select);

            return $result;
        } catch (Zend_Db_Exception $e) {

            echo $e;
            return false;
        }
    }

    public function updateDados($idLab, $local, $data, $turnoVisita, $nomeLaboratorio, $somenteAula, $frequenciaAula, $turnoAula, $quantGabinete, $quantTipoGabinete, $sisOperacional, $licencaDti, $ocsInstalado, $ipsServidores, $estruturaLRede, $roteador, $ipEntrada, $ipSaida, $nomeResponsavel, $ramal, $email, $acessoRemoto, $backup, $firewall, $observacoes) {

        try {


            $data = array(
                'local' => $local,
                'data' => $data,
                'turnoVisita' => $turnoVisita,
                'nomeLaboratorio' => $nomeLaboratorio,
                'somenteAula' => $somenteAula,
                'frequenciaAula' => $frequenciaAula,
                'turnoAula' => $turnoAula,
                'quantGabinete' => $quantGabinete,
                'quantTipoGabinete' => $quantTipoGabinete,
                'sisOperacional' => $sisOperacional,
                'licencaDti' => $licencaDti,
                'ocsInstalado' => $ocsInstalado,
                'ipsServidores' => $ipsServidores,
                'estruturaLRede' => $estruturaLRede,
                'roteador' => $roteador,
                'ipEntrada' => $ipEntrada,
                'ipSaida' => $ipSaida,
                'nomeResponsavel' => $nomeResponsavel,
                'ramal' => $ramal,
                'email' => $email,
                'acessoRemoto' => $acessoRemoto,
                'backUp' => $backup,
                'firewall' => $firewall,
                'observacoes' => $observacoes
            );
            $where = "idLab = " . $idLab;

            $this->update($data, $where);




            return true;
        } catch (Zend_Db_Exception $e) {

            echo $e;

            print_r($where);
            return false;
        }
    }

    public function deleteDados($idLab) {

        try {
            $where = 'idLab = ' . $idLab;
            $tabela = 'lab';
            $this->delete($where, $tabela);
        } catch (Zend_Db_Exception $e) {
            echo $e;
            return false;
        }
    }

}
