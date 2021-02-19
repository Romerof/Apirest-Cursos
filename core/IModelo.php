<?php 
require_once("bd/Provider.php");
interface IModelo{ /** refactorizar | intefaz modelos | valores de retorno */
  public function all();
  public function find(string $dato, string $columna);
  public function add(array $datos);
  public function update(array $datos);
  public function delete(string $id);
}
?>