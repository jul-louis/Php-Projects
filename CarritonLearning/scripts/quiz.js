var cNav = document.getElementById("course-nav");
var tcButton = document.getElementById("to-course-button");

if (tcButton !== null) {
    tcButton.addEventListener('mouseover', ev => {
        showElement(cNav);
    })
}
if (cNav !== null) {
    cNav.addEventListener("mouseover", ev=> {
        showElement(cNav);
    })
    cNav.addEventListener("mouseout", ev => {
        hideElement(cNav);
    })
    cNav.addEventListener("mouseleave", ev => {
        hideElement(cNav);
    })
}

function grade() {
    let correctCount = 0;
    for (let i=0; i<mcsTFs.length; i++) {
        let qid = mcsTFs[i];
        let num = parseInt(qid.charAt(3));
        if (document.querySelector('input[name='+qid+']:checked') !== null) {
            let answer = document.querySelector('input[name='+qid+']:checked').id;
            if (answer === mcsTFsA[i]) {
                correctCount++;
                if (!isNaN(num)) {
                    stats[num] = true;
                }
            } else {
                if (!isNaN(num)) {
                    stats[num] = false;
                }
            }
        }
    }
    for (let i=0; i<mas.length; i++) {
        let qids = mas[i];
        let userAnswer = "";
        for (let i=0; i<qids.length; i++) {
            if (document.querySelector('input[name='+qids[i]+']:checked') !== null) {
                userAnswer += document.querySelector('input[name='+qids[i]+']:checked').id.toString();
            }
        }
        let numMA = parseInt(userAnswer.charAt(3));
        if (userAnswer === masA[i]) {
            correctCount++;
            if (!isNaN(numMA)) {
                stats[numMA] = true;
            }
        } else {
            if (!isNaN(numMA)) {
                stats[numMA] = false;
            }
        }
    }
    printGrade(answerCollection.length, correctCount);
    alert("Quiz Submitted.\nYour Grade:\n" + correctCount/(mcsTFs.length+mas.length)*100 +"%, "+ correctCount +" out of " + (mcsTFs.length+mas.length))
}

function printGrade(total_question, correct) {
    let gradeArea = document.getElementById("g-area");
    gradeArea.style.padding = "20px";
    gradeArea.innerHTML = "<h4>" +"Grade: " + correct/total_question*100 + "%, " + correct + " / " + total_question + "</h4>";
}

function printAnswer() {
    let right = "✅ Your Answer is Correct! ";
    let wrong = "❌ Your Answer is Wrong... ";
    for (let i=0; i<answerCollection.length; i++) {
        let area = document.getElementById("qid"+i+"a");
        area.style.padding = "15px"
        if (stats[i] === true) {
            area.innerHTML =  right + answerCollection[i];
        } else {
            area.innerHTML = wrong + answerCollection[i];
        }
    }
}

$('#quiz').submit(function () {
    grade();
    printAnswer();
    return false;
});