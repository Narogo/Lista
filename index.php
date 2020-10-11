<?php
require_once 'database.php';

class Lista
{
    private $db;
    private $res;
    private $listaID;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showRows()
    {
        $sql = $this->db->prepare("SELECT * FROM zadania");

        $sql->execute();

        $query = $sql->rowCount();

        if ($sql->rowCount() > 0)
        {
            $response = "";

                while ($data = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    $response .= '
                            <tr>
                                <td>' . $data["id"] . '</td>
                                <td id="lista_'.$data["id"].'">'. $data["nazwa"] . '</td>
                                <td>' . $data["data_dodania"] .'</td>
                                <td>'. $data["data_rozpo"] .'</td>
                                <td>'. $data["data_zakon"] .'</td>
                                   <td>'. $data["aktywne"] .'</td>
                                <td>
                                    <input type="button" onclick="edit('.$data["id"].')" value="Edit" class="btn btn-primary">
                                    <input type="button" onclick="view('.$data["id"].')" value="View" class="btn">
                                    <input type="button" onclick="deleteR('.$data["id"].')" value="Delete" class="btn btn-danger">
                                    <input type="button" onclick="start('.$data["id"].')" value="Zacznij" class="btn btn-outline-secondary">
                                    <input type="button" onclick="finish('.$data["id"].')" value="Zakończ" class="btn btn-dark">
                                </td>
                            </tr>
                        ';
                }
           return exit($response);
        }
    }

    public function addRow($nazwa, $longDes, $shortDes)
    {
        $data=date("Y-m-d");

        $sql ="INSERT INTO `zadania`(`id`, `nazwa`, `longDes`, `shortDes`, `data_dodania`, `data_rozpo`, `data_zakon`, `aktywne`) VALUES (NULL,?,?,?,?,'-','-','Nie')";
        $query = $this->db->prepare($sql);

        $query->execute([$nazwa, $longDes, $shortDes,$data]);
    }

    public function editRow($id)
    {
        $sql = $this->db->prepare("SELECT nazwa, shortDes, longDes FROM zadania WHERE id=:id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);

        $sql->execute();

        $data = $sql->fetch(PDO::FETCH_ASSOC);

        $json = array(
            'name1' => $data['nazwa'],
            'shortDes1' => $data['shortDes'],
            'longDes1'=> $data['longDes']
        );

        return exit(json_encode($json));
    }

    public function update($name, $shortDes, $longDes, $id)
    {
        $sql="UPDATE `zadania` SET `nazwa`= ?,`longDes`= ?,`shortDes`= ? WHERE id = ?";
        $query = $this->db->prepare($sql);

        $query->execute([$name, $shortDes, $longDes, $id]);
    }

    public function deleteRow($id)
    {
        $sql = "DELETE FROM zadania WHERE id=?";
        $query = $this->db->prepare($sql);

        $query->execute([$id]);
    }

    public function start($id)
    {
        $data=date("Y-m-d");
        //$czas=date("H:i");
        $sql="UPDATE `zadania` SET `data_rozpo`= ?,`aktywne`= 'Tak' WHERE id = ?";
        $query = $this->db->prepare($sql);

        $query->execute([$data,$id]);
    }

    public function finish($id)
    {
        $this->listaID = $id;

        $this->base($this->listaID);

        if($this->res == "Nie")
        {
            $error = "error";
        }
        else
        {
            $data = date("Y-m-d");
            // $czas=date("H:i");
            $sql = "UPDATE `zadania` SET `data_zakon`=?,`aktywne`='Ukończone' WHERE id = ?";
            $query = $this->db->prepare($sql);

            $query->execute([$data, $id]);

            $error= $this->res;
        }
        return exit($error);
    }

    public function base($listaID)
    {

        $sql = $this->db->prepare("SELECT * FROM zadania WHERE id = :id");
        $sql->bindValue(":id", $listaID, PDO::PARAM_INT);
        $sql->execute();

        $data = $sql->fetch(PDO::FETCH_ASSOC);

        $this->res = $data['aktywne'];

        return $this->res;
    }

}


if(isset($_POST['key']))
{
    $lista = new Lista($db);

    if($_POST['key']== 'getRows')
    {
        $lista->showRows();
    }

    if($_POST['key'] == 'addNew')
    {
        $lista->addRow($_POST['name'],$_POST['longDes'], $_POST['shortDes']);
    }

    if($_POST['key'] == 'getEdit')
    {
        $lista->editRow($_POST['id']);
    }

    if($_POST['key'] == 'delete')
    {
        $lista->deleteRow($_POST['rowID']);
    }

    if($_POST['key']== "update")
    {
        $lista->update($_POST['name'], $_POST['shortDes'], $_POST['longDes'],$_POST['editID']);
    }
    if($_POST['key'] == "start")
    {
        $lista->start($_POST['id']);
    }
    if($_POST['key'] == "finish")
    {
        $lista->finish($_POST['id']);
    }
}


