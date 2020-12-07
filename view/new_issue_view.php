
<section id="new_issue">
    <h1>Create Issue</h1>

    <p class="error" id="title-error"></p>
    <label for="title">Title</label>
    <input type="text" id="title" name="title">

    <p class="error" id="description-error"></p>
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    
    <label for="assigned_to">Assigned To</label>
    <select id="assigned_to" name="assigned_to">
    </select>

    <label for="type">Type</label>
    <select id="type" name="type">
        <option value="Bug">Bug</option>
        <option value="Proposal">Proposal</option>
        <option value="Task">Task</option>
    </select>
    
    <label for="priority">Priority</label>
    <select id="priority" name="priority">
        <option value="Minor">Minor</option>
        <option value="Major">Major</option>
        <option value="Critical">Critical</option>
    </select>

    <button id="submit-issue-btn">Submit</button>

    <p class="msg"></p>
</section>