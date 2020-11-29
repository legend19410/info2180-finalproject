
<section id="new_issue">
    <h1>Create Issue</h1>
    <label for="title">Title</label>
    <input type="text" id="title" name="title">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    
    <label for="assigned_to">Assigned To</label>
    <select id="assigned_to" name="assigned_to">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="fiat">Fiat</option>
        <option value="audi">Audi</option>
    </select>

    <label for="type">Type</label>
    <select id="type" name="type">
        <option value="bug">Bug</option>
        <option value="proposal">Proposal</option>
        <option value="task">Task</option>
    </select>
    
    <label for="priority">Priority</label>
    <select id="priority" name="priority">
        <option value="minor">Minor</option>
        <option value="major">Major</option>
        <option value="critical">Critical</option>
    </select>

    <button id="submit-issue-btn">Submit</button>

    <p class="msg"></p>
</section>