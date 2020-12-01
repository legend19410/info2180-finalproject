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
                echo "<td>#".$row['id']." ".$row['title']."</td>";
                echo "<td>".$row['type']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "<td>".$row['assigned_to']."</td>";
                echo "<td>".$row['created']."</td>";
            echo "</tr>";
            }
            echo '</tbody>';
        echo '</table>';

    }

    public function getIssue($id){
        $issue = $this->db_conn->getIssue($id);

        echo "<section id='issue'>
                    <section class='container'>
                        <div class='header'>
                            <h1>{$issue['title']}</h1>
                            <h3>#{$issue['id']}</h3>
                        </div>
                        <div class='body'>
                            <p class='description'>{$issue['description']}</p>
                            <p class='creation-date'>> Issue created on {$issue['created']} by {$issue['created_by']}</p>
                            <p class='updated-date'>> Last updated on {$issue['updates']}</p>
                        </div>
                        <div class='sidebar'>
                            <div>
                                <label>Assigned To:</label>
                                <p>{$issue['assigned_to']}</p>
                                <label>Type:</label>
                                <p>{$issue['type']}</p>
                                <label>Priority:</label>
                                <p>{$issue['priority']}</p>
                                <label>Status:</label>
                                <p>{$issue['status']}</p>
                            </div>
                            <button class='mark-close-btn'>Mark as Closed</button>
                            <button class='mark-progress-btn'>Mark in Progress</button>
                        </div>
                    </section>
              </section>";
    }

    public function createIssue($title, $description, $type, $priority, $assigned_to, $created_by){
        //1. sanitize

        //2. insert into db
        $this->db_conn->insertIssue($title, $description, $type, $priority, $assigned_to, $created_by);
    }
}