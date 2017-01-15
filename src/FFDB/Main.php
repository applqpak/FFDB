<?php

  class FFDBException extends \Exception
  {
  }

  class FFDB
  {
      private $db;
      private $file;

      public function __construct($file)
      {
          $this->file = $file . '.ffdb';
          if(!(file_exists($this->file))) touch($this->file);
          $this->load();
          return true;
      }

      public function __get($key)
      {
          return $this->get($key);
      }

      public function __set($key, $value)
      {
          return $this->set($key, $value);
      }

      private function load()
      {
          $this->db = unserialize(file_get_contents($this->file));
          return true;
      }

      public function save()
      {
          file_put_contents($this->file, serialize($this->db));
          $this->load();
          return true;
      }

      public function exists($key)
      {
          return (isset($this->db[$key]) ? true : false);
      }

      public function get($key)
      {
          return (isset($this->db[$key]) ? $this->db[$key] : false);
      }

      public function set($key, $value)
      {
          $this->db[$key] = $value;
          return true;
      }
  }
