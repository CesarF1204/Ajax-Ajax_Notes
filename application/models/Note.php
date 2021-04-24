<?php
    class Note extends CI_Model {
        public function all() {
            $query = "SELECT * FROM notes";
            return $this->db->query($query)->result_array();
        }
        public function create($new_note){
            $query = "INSERT INTO notes (title, created_at, updated_at) VALUES (?, NOW(), NOW())";
            $values = array($new_note['title']);
            return $this->db->query($query, $values);
        }
        public function update_note($note_id, $note_updates){
            $where = "id = ". $note_id; 
            return $this->db->update('notes', $note_updates, $where);
        }
        public function delete_note($id){
            $query = "DELETE FROM notes WHERE notes.id = $id";
            return $this->db->query($query);
        }
    }
?>