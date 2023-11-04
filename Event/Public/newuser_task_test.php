<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <title>Get Started Tasks</title>
</head>
<body>

<style>

.task-card {
    display: flex;
    justify-content: space-around;
    margin: 50px;
}

.task {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 200px;
    text-align: center;
}

.task-name {
    font-size: 1.5rem;
    font-weight: bold;
}

.task-description {
    font-size: 1rem;
    color: #555;
}

.task-checkbox {
    width: 30px;
    height: 30px;
    background-color: #ccc;
    border-radius: 50%;
    margin: 20px auto 0;
    cursor: pointer;
}

.task-checkbox.checked {
    background-color: #4caf50;
}


</style>

<div class="task-card">
    <div class="task">
        <span class="task-name">Task 1</span>
        <p class="task-description">Task Description 1</p>
        <div class="task-checkbox"></div>
    </div>
    <div class="task">
        <span class="task-name">Task 2</span>
        <p class="task-description">Task Description 2</p>
        <div class="task-checkbox"></div>
    </div>
    <div class="task">
        <span class="task-name">Task 3</span>
        <p class="task-description">Task Description 3</p>
        <div class="task-checkbox"></div>
    </div>
</div>

</body>
</html>
