<?php 


class ClientManager
{
      
      /**
       * Objet passe en argument
       * Cet objet n'a pas de valeur d'identifiant (il est null)
       * car elle est determinee a l'insersion par le SGBDR
       * 
       * Apres insertion, il faut << rafraichir >> l'objet passe en
       * argument de facon a ce que le programme appelant dispose d'un objet avec l'identifiant
       * 
       * Methode retourne TRUE si l'insertion a reussi, FALSE dans le cas contraire
      */
	  public function create(Client $client)
	  {
          // insertion de l'objet passe en argument
	  	  // met a jour l'identifant de l'objet
	  	  // retourne TRUE OR FALSE
	  }

      
      /**
       * Methode Read permet de recuperer un ou plusieurs objets
       *  concerne read(id) , readAll()
       * 
       * Il peut y en avoir plusieurs en fonction de la facon dont ont recupere l'objet
       * ou les objets
       * - recuperation par l'identifiant (c'est le cas ici)
       * - recuperation par le prenom, etc
       * - recuperation de tous les objets
       * - etc
      */
	  public function read($id)
	  {
	  	   // recuperation de l'objet avant l'identifiant
	  	   // $id passe en argument
	  	   // retourne un objet Client ou NULL
	  }


	  public function readAll()
	  {
	  	   // recuperation de tous les objets de la BDD
	  	   // retourne un tableau d'objets Client ou un tableau vide
	  }

      

      /**
       * Methodes update et delete
       * Elles permettent respectivement de mettre a jour un objet et de le supprimer
       * 
       * L'argument a passer a ces 2 methodes esr un OBJET du type de l'entite concerne
       * 
       * Cette methode retourne TRUE si la mise a jour / sppression a reussi, FALSE dans le cas contraire
      */
	  public function update(Client $client)
	  {
	  	   // mise a jour de l'objet passe en argument
	  	   // retourne TRUE ou FALSE
	  }


	  public function delete(Client $client)
	  {
	  	  // suppression de l'objet passe en argument
	  	  // retourne TRUE OU FALSE
	  }
}