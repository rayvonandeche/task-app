<?php include 'components/header.php'; ?>

<h2>Welcome! Sign up here.</h2>

<form action="/task-app/public/index.php?action=register" method="POST">
    <label>Name:

        <input type="text" id="name" name="name" required>
    </label> <br> <br>

    <label>Email:

        <input type="email" id="email" name="email" required>
    </label> <br><br>

    <button type="submit">Register</button><br><br>
</form>

<?php include 'components/footer.php'; ?>