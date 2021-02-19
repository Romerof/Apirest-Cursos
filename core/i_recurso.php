<<?php 
interface IRecurso {

    public function index(): void;
    public function get (): void;
    public function post (): void;
    public function put (): void;
    public function delete (): void;
    
}
?>