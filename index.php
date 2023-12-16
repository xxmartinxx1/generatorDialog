<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Generator scenariusza dialogowego by MartinQa</title>
    <!-- Dodaj Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<style>
    .form-group {
        display: flex; /* Dodaj display flex */
        align-items: center; /* Centruj elementy w pionie */
        margin-bottom: 0.5rem; /* Drobny margines między grupami */
        margin-left: 10px; /* Drobny margines między grupami */
    }
    .moja-klasa {
        /* Dodaj swoje style tutaj */
        margin-left: 10px;
        margin-right: 10px;
        /* itd. */
    }

</style>
<body>
<div class="container mt-5">
    <form action="#" class="form-inline">
        <h2 class="mb-4">Generator scenariusza dialogowego  by MartinQa</h2>
        <div class="form-group">
            <label for="scenarioName">Nazwa scenariusza</label>
            <input type="text" class="form-control moja-klasa" name="scenarioName" id="scenarioName" placeholder="Nazwa scenariusza">
        </div>
        <br>
        <div id="questions"></div>
        <button type="button" class="btn btn-primary" id="addQuestion">Dodaj pytanie</button>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Generuj</button>
    </form>
</div>

<script>
    const questions = document.querySelector('#questions');

    const addQuestionButton = document.querySelector('#addQuestion');

    addQuestionButton.addEventListener('click', () => {
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question', 'border', 'p-3', 'mb-3');

        const questionKeyInput = document.createElement('input');
        questionKeyInput.type = 'text';
        questionKeyInput.classList.add('form-control', 'mb-2');
        questionKeyInput.placeholder = 'Klucz pytania (questionKey)';
        newQuestion.appendChild(questionKeyInput);

        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.classList.add('form-control', 'mb-2');
        questionInput.placeholder = 'Tekst pytania';
        newQuestion.appendChild(questionInput);

        const optionsInput = document.createElement('div');
        optionsInput.classList.add('options');

        const addOptionButton = document.createElement('button');
        addOptionButton.textContent = 'Dodaj opcję';
        addOptionButton.classList.add('btn', 'btn-secondary', 'mb-2');
        optionsInput.appendChild(addOptionButton);

        addOptionButton.addEventListener('click', () => {
            const optionRow = document.createElement('div');
            optionRow.classList.add('form-group', 'mb-2'); // Dodaj klasę 'form-group'

            const optionsLabel = document.createElement('label');
            optionsLabel.textContent = 'Klucz następnego pytania';
            optionsLabel.classList.add('col-form-label');
            optionsLabel.setAttribute('for', 'optionInput');
            optionRow.appendChild(optionsLabel);

            const optionInput = document.createElement('input');
            optionInput.type = 'text';
            optionInput.classList.add('form-control', 'mb-2');
            optionInput.placeholder = 'Opcja';
            optionInput.id = 'optionInput';
            optionInput.style.width = '40%';
            optionInput.classList.add("moja-klasa");

            optionRow.appendChild(optionInput);

            const nextLabel = document.createElement('label');
            nextLabel.textContent = 'Następny scenariusz (opcjonalnie)';
            nextLabel.classList.add('col-form-label');
            nextLabel.setAttribute('for', 'nextInput');
            optionRow.appendChild(nextLabel);

            const nextInput = document.createElement('input');
            nextInput.type = 'text';
            nextInput.classList.add('form-control', 'mb-2');
            nextInput.placeholder = 'Następny scenariusz (opcjonalnie)';
            nextInput.id = 'nextInput';
            nextInput.style.width = '50%';
            optionRow.appendChild(nextInput);

            optionsInput.appendChild(optionRow);
        });


        const removeQuestionButton = document.createElement('button');
        removeQuestionButton.textContent = 'Usuń pytanie';
        removeQuestionButton.classList.add('btn', 'btn-danger', 'mb-2');
        removeQuestionButton.addEventListener('click', () => {
            newQuestion.remove();
        });
        optionsInput.appendChild(removeQuestionButton);

        newQuestion.appendChild(optionsInput);

        questions.appendChild(newQuestion);
    });

    const form = document.querySelector('form');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const scenarioName = document.querySelector('#scenarioName').value;
        const inputQuestions = questions.querySelectorAll('.question');

        let scenario = {};
        scenario[scenarioName] = {};

        for (let i = 0; i < inputQuestions.length; i++) {
            const questionKeyInput = inputQuestions[i].querySelectorAll('input')[0];
            const questionInput = inputQuestions[i].querySelectorAll('input')[1];
            const optionInputs = inputQuestions[i].querySelectorAll('.options input');
            const options = [];

            for (let j = 0; j < optionInputs.length; j += 2) {
                const optionText = optionInputs[j].value.trim();
                const nextScenario = optionInputs[j + 1].value.trim();

                if (optionText !== '') {
                    const option = { text: optionText };

                    if (nextScenario !== '') {
                        option.next = nextScenario;
                    }

                    options.push(option);
                }
            }

            const question = {
                text: questionInput.value,
                options: options,
            };

            // Ustaw questionKey w scenariuszu
            const key = questionKeyInput.value;
            scenario[scenarioName][key] = question;
        }

        const json = JSON.stringify(scenario, null, 4);

        // Wyświetl kod JSON w konsoli
        console.log(json);
    });
</script>
<!-- Dodaj Bootstrap JS i jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
</body>
</html>
