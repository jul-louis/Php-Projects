<script>
    let mcsTFs = [];
    let mcsTFsA = [];
    let mas = [];
    let masA = [];
    let answerCollection = [];
    let stats = Array(8);
</script>

<?php
$_SESSION['mctf_answers'] = [];
$_SESSION['ma-answers'] = [];

function parseNotesOverview($notes) {
    $pattern_overview = '{<overview>([\s\S]*?)<\/overview>}';
    if (preg_match($pattern_overview, $notes, $matches)) {
        echo "<h2>".$matches[1]."</h2><hr/>";
    }
}

function parseNotesTopics($notes) {
    $pattern_topic = '{<topic>([\s\S]*?)</topic>}';
    if (preg_match_all($pattern_topic, $notes, $matches)) {
        $topics = $matches[1];
        for ($i=0; $i<count($topics); $i++) {
            $topic_title = parseTopicTitle($topics[$i]);
            parseAllSubtopics($topic_title, $topics[$i]);

        }
    }
}

function parseTopicTitle($topic) {
    $pattern_topic = '{<title>([\s\S]*?)</title>}';
    if (preg_match($pattern_topic, $topic, $matches)) {
        return $matches[1];
    }
    return '';
}

function parseSubtopicTitle($subtopic) {
    $pattern_subtopic = '{<title>([\s\S]*?)</title>}';
    if (preg_match($pattern_subtopic, $subtopic, $matches)) {
        return $matches[1];
    }
    return '';
}

function parseAllSubtopics($topic_title, $topics) {
    $pattern = '{<subtopic>([\s\S]*?)</subtopic>}';
    if (preg_match_all($pattern, $topics, $matches)) {
        $subtopics = $matches[1];
        for ($i=0; $i<count($subtopics); $i++) {
            $subtopic_title = parseSubtopicTitle($subtopics[$i]);
            echo "<h2>".$topic_title." - ".$subtopic_title."</h2>";
            parseEntries($subtopics[$i]);

        }
    }
}

function parseEntries($subtopics) {
    $pattern = '{<entry>([\s\S]*?)</entry>}';
    if (preg_match_all($pattern, $subtopics, $matches)) {
        $entries = $matches[1];
        for ($i=0; $i<count($entries); $i++) {
            echo "<p class='disc'>".$entries[$i]."</p>";
        }
        echo "<hr/>";
    }
}

function parseQuizQuestions($quiz) {
    $pattern = '{<question>([\s\S]*?)</question>}';
    if (preg_match_all($pattern, $quiz, $matches)) {
        $questions = $matches[1];
        for ($i=0; $i<count($questions); $i++) {
            $desc = parseQuestionDesc($questions[$i]);
            echo "<h2 class='numerical'>".$desc."</h2>";
            $type = parseQuestionType($questions[$i]);
            parseExplanation($questions[$i]);
            if ($type == "MC" || $type == "TF") {
                // MCTF:
                parseCorrectAnswers($i, $questions[$i], false);
                parseQuestionChoices($i, $questions[$i], false);
            } else if ($type == "MA") {
                // MA:
                parseCorrectAnswers($i, $questions[$i], true);
                parseQuestionChoices($i, $questions[$i], true);
            }
        }
    }
}

function parseExplanation($question) {
    $pattern = '{<explanation>([\s\S]*?)</explanation>}';
    if (preg_match($pattern, $question, $matches)) {
        echo "<script> var x='".$matches[1]."'; answerCollection.push(x)</script>";
    }
}

function parseCorrectAnswers($qid, $question, $is_ma) {
    $pattern = '{<answer>([\s\S]*?)</answer>}';
    if (preg_match($pattern, $question, $matches)) {
        if ($is_ma) {
            // MA
            echo "<script> var x='".$matches[1]."'; masA.push(x)</script>";
        } else {
            // MCTF
            echo "<script> var y='qid".$qid."'; mcsTFs.push(y)</script>";
            echo "<script> var x='qid".$qid."cid".$matches[1]."'; mcsTFsA.push(x)</script>";
        }
    }
}

function parseQuestionDesc($question) {
    $pattern = '{<description>([\s\S]*?)</description>}';
    echo '<div class="answer" id="g-area"></div>';
    if (preg_match($pattern, $question, $matches)) {
        return $matches[1];
    }
    return '';
}

function parseQuestionType($question) {
    $pattern = '{<type>([\s\S]*?)</type>}';
    if (preg_match($pattern, $question, $matches)) {
        return $matches[1];
    }
    return '';
}

function parseQuestionChoices($qid, $question, $is_ma) {
    $pattern_choices = '{<choices>([\s\S]*?)</choices>}';
    if (preg_match($pattern_choices, $question, $match )) {
        $choices_group = $match[1];
        $pattern = "{<choice>([\s\S]*?)</choice>}";
        if (preg_match_all($pattern, $choices_group, $matches)) {
            $choices = $matches[1];
            if (!$is_ma) {
                for ($i=0; $i<count($choices); $i++) {
                    $name = "qid".$qid;
                    $id = $name."cid".$i;
                    echo "<div class='choices'><label class='font2'><input type='radio' name='".$name."' id='".$id."'>&emsp;&emsp;&emsp;".$choices[$i]."</label></div>";
                }
            } else {
                $counter = 0;
                for ($i=0; $i<count($choices); $i++) {
                    $counter++;
                    $name = "qid".$qid;
                    $id = $name."cid".$i;
                    echo "<div class='choices'><label class='font2'><input type='checkbox' name='".$id."' id='".$id."'>&emsp;&emsp;&emsp;".$choices[$i]."</label></div>";
                }
                echo "<script>
                        var cnt=".$counter.";
                        var box = [];
                        for (let i=0; i<cnt; i++) {
                            var y='qid".$qid."cid'+i; 
                            box.push(y);
                        }
                        mas.push(box)
                      </script>";

            }
            echo "<br/><div id='qid".$qid."a' class='answer'></div><br/>";
        }
    }
}