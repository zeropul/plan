<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> 배포시나리오 생성 </title>
<meta charset="UTF-8">
<meta name="description" content="Free Web tutorials">
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="author" content="Hege Refsnes">
<style type="text/css">
* {
  margin: 0;
  padding: 0;
}

form {
  margin: 0;
  padding: 0;
  font-size: 100%;
  min-width: 560px;
  max-width: 620px;
  width: 590px;
}

form fieldset {
  clear: both;
  font-size: 100%;
  border-color: #000000;
  border-width: 1px 0 0 0;
  border-style: solid none none none;
  padding: 10px;
  margin: 0 0 0 0;
}

form fieldset legend {
    line-height: 150%;
}


form fieldset legend {
  font-size: 120%;
  font-weight: normal;
  color: #000000;
  margin: 0 0 0 0;
  padding: 0 5px;
}

form div.required fieldset legend {
  font-weight: bold;
}
div.required label:before {
  content: '';
}

form div {
    clear: left;
    display: block;
    width: 354px;
    zoom: 1;
    margin: 5px 0 0 0;
    padding: 1px 3px;
}
form div.submit {
  width: 214px;
  padding: 0 0 0 146px;
}

form div.submit div {
  display: inline;
  float: left;
  text-align: left;
  width: auto;
  padding: 0;
  margin: 0;
}

form div input.inputSubmit, form div input.inputButton, input.inputSubmit, input.inputButton {
  background-color: #cccccc;
  color: #000000;
  width: auto;
  height:30px;
  padding: 0 6px;
  margin: 0;
}

legend {
    display: block;
    -webkit-padding-start: 2px;
    -webkit-padding-end: 2px;
    border: none;
    border-image-source: initial;
    border-image-slice: initial;
    border-image-width: initial;
    border-image-outset: initial;
    border-image-repeat: initial;
}
</style>
 </head>

 <body>
<form name="frm1" action="planExec.php" method="post" enctype="multipart/form-data">
<fieldset>
    <legend>배포시나리오 및 diff 파일 생성</legend>
    <div class="required wide">
        <label for="jira_code">지라코드 :</label>
        <input type="text" name="jira_code" id="jira_code" />
    </div>
    <div class="required wide">
        <label for="file_list">파일경로 :</label>
        <textarea name="file_list" id="file_list" class="inputTextarea" rows="10" cols="70"></textarea>
    </div>
    <div class="optional">
        <label for="diff_file">diff 파일:</label>
        <input type="file" name="diff_file" id="diff_file" class="inputFile">
    </div>
</fieldset>
<fieldset>
  <div class="submit">
    <div>
      <input type="submit" class="inputSubmit" value="배포시나리오 생성" />
    </div>
  </div>
</fieldset>

</form>
 </body>
</html>
