<?php

class Issue{
    private $db_conn;
    
    public function __construct($db_conn){
        $this->db_conn = $db_conn;
    }
    public function getAllIssues(){
        $issues = $this->db_conn->getAllIssues();
        $this->constructTable($issues);
    }
    public function getOpenIssues(){
        $issues = $this->db_conn->getOpenIssues();
        $this->constructTable($issues);
    }
    public function getMyTicketIssues($user_id){
        $issues = $this->db_conn->getMyTicketIssues($user_id);
        $this->constructTable($issues);
    }
    

    public function getIssue($id){
        $issue = $this->db_conn->getIssue($id);
        echo "<section id='issue'>
                    <section class='container'>
                        <div class='header'>
                            <h1>{$issue['title']}</h1>
                            <h3>Issue #{$issue['id']}</h3>
                        </div>
                        <div class='body'>
                            <p class='description'>{$issue['description']}</p>
                            <p class='creation-date'>> Issue created on {$issue['created']} by {$this->getNameOfUser($issue['created_by'])}</p>
                            <p class='updated-date'>> Last updated on {$issue['updates']}</p>
                        </div>
                        <div class='sidebar'>
                            <div>
                                <label>Assigned To:</label>
                                <p>{$issue['firstname']} {$issue['lastname']}</p>
                                <label>Type:</label>
                                <p>{$issue['type']}</p>
                                <label>Priority:</label>
                                <p>{$issue['priority']}</p>
                                <label>Status:</label>
                                <p id='status'>{$issue['status']}</p>
                            </div>
                            <button class='mark-close-btn'>Mark as Closed</button>
                            <button class='mark-progress-btn'>Mark in Progress</button>
                        </div>
                    </section>
              </section>";
    }

    public function createIssue($title, $description, $type, $priority, $assigned_to, $created_by){
        //1. sanitize data

        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $type = htmlspecialchars($type);
        $priority = htmlspecialchars($priority);
        $assigned_to = htmlspecialchars($assigned_to);
        $created_by = htmlspecialchars($created_by);

        //2. insert into db
        $this->db_conn->insertIssue($title, $description, $type, $priority, $assigned_to, $created_by);

        //3. return msg to user
    }

    private function constructTable($issues){
        if (count($issues)>0){
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
                    echo "<td><span>#".$row['id']."</span> <span>".$row['title']."</span></td>";
                    echo "<td>".$row['type']."</td>";
                    echo "<td>".$row['status']."</td>";
                    echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
                    echo "<td>".$row['created']."</td>";
                echo "</tr>";
                }
                echo '</tbody>';
            echo '</table>';
        }
        else{
            echo "<div> No Issues </div>";
        }
    }
    
    public function closeIssue($id){
        $this->db_conn->closeIssue($id);
        return $this->getIssue($id);
    }

    public function progressIssue($id){
        $this->db_conn->progressIssue($id);
        return $this->getIssue($id);
    }

    public function getNameOfUser($id){
        $name = $this->db_conn->getNameOfUser($id);
        $name = $name['firstname']." ".$name['lastname'];
        return $name;
    }
}