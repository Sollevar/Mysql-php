const select = document.getElementById('job_in_database');
const jobInput = document.getElementById('job');
const salaryInput = document.getElementById('salary');

const selectDep = document.getElementById('dep_in_database');
const inputDep = document.getElementById('dep');

const selectContragents = document.getElementById('contragent_in_database');
const inputContrType = document.getElementById('contragent_type');
const inputContrName = document.getElementById('contragent_name');
const inputContrAddr = document.getElementById('contragent_addr');
console.log(selectContragents);
console.log(inputContrType)

if(select){
    select.addEventListener('change', function() {
        let selectedValue = this.options[this.selectedIndex].value;
        if (selectedValue !== '') {
            jobInput.disabled = true;
            salaryInput.disabled = true;
        } else {
            jobInput.disabled = false;
            salaryInput.disabled = false;
        }
    });
}

if(jobInput){
    jobInput.addEventListener('change', function() {
        if (jobInput.value !== '') {
            select.disabled = true;
        } else {
            select.disabled = false;
        }
    });
}

if(selectDep){
    selectDep.addEventListener('change', function() {
        let selectedValue = this.options[this.selectedIndex].value;
        if (selectedValue !== '') {
            inputDep.disabled = true;
        } else {
            inputDep.disabled = false;
        }
    });
}

if(inputDep){
    inputDep.addEventListener('change', function() {
        if (inputDep.value !== '') {
            selectDep.disabled = true;
        } else {
            selectDep.disabled = false;
        }
    });
}

if(selectContragents){
    selectContragents.addEventListener('change', function() {
        let selectedValue = this.options[this.selectedIndex].value;
        if (selectedValue !== '') {
            inputContrType.disabled = true;
            inputContrName.disabled = true;
            inputContrAddr.disabled = true;
        } else {
            inputContrType.disabled = false;
            inputContrName.disabled = false;
            inputContrAddr.disabled = false;
        }
    });
}

if(inputContrName){
    inputContrName.addEventListener('change', function() {
        if (inputContrName.value !== '') {
            selectContragents.disabled = true;
        } else {
            selectContragents.disabled = false;
        }
    });
}
