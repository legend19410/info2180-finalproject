<?php

class Issue{
    private $db_conn;
    
    public function __construct($db_conn){
        $this->db_conn = $db_conn;
    }
    public function getAllIssues(){
        // return $this->db_conn->getAllIssues();
        $issues = $this->db_conn->getAllIssues();

        echo '<table>';
            echo '<thead>';
            echo '<tr>';
                echo "<th>Title</th>";
                echo "<th>Type</th>";
                echo "<th>Status</th>";
                echo "<th>Assigned To</th>";
                echo "<th>Created</th>";
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach($issues as $row){
            echo "<tr id='".$row['id']."'>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['type']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "<td>".$row['assigned_to']."</td>";
                echo "<td>".$row['created']."</td>";
            echo "</tr>";
            }
            echo '</tbody>';
        echo '</table>';

    }

    public function createIssue($title, $description, $type, $priority, $assigned_to, $created_by){
        //1. sanitize

        //2. insert into db
        $this->db_conn->insertIssue($title, $description, $type, $priority, $assigned_to, $created_by);
    }
}