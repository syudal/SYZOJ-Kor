<?php $show_title = "$MSG_LOGIN - $OJ_NAME"; ?>
<?php include("template/$OJ_TEMPLATE/header.php"); ?>
<div class="padding">
  <h1>회원 정보 수정</h1>
  <div class="ui error message" id="error" data-am-alert hidden>
    <p id="error_info"></p>
  </div>
  <form action="modify.php" method="post" role="form" class="ui form">
    <div class="field">
      <label for="username">
        <?php echo $MSG_USER_ID ?>
      </label>
      <input class="form-control" placeholder="" disabled="disabled" type="text"
        value="<?php echo $_SESSION[$OJ_NAME . '_' . 'user_id'] ?>">
    </div>
    <?php require_once('./include/set_post_key.php'); ?>
    <div class="field">
      <label for="username">
        <?php echo $MSG_NICK ?>*
      </label>
      <input name="nick" placeholder="" type="text"
        value="<?php echo htmlentities($row['nick'], ENT_QUOTES, "UTF-8") ?>">
    </div>
    <div class="field">
      <label class="ui header">
        <?php echo $MSG_PASSWORD ?>*
      </label>
      <input name="opassword" placeholder="" type="password">
    </div>
    <div class="two fields">
      <div class="field">
        <label class="ui header">
          <?php echo $MSG_PASSWORD ?>
        </label>
        <input name="npassword" placeholder="" type="password">
      </div>
      <div class="field">
        <label class="ui header">
          <?php echo $MSG_REPEAT_PASSWORD ?>
        </label>
        <input name="rptpassword" placeholder="" type="password">
      </div>
    </div>
    <div class="field">
      <label for="username">
        <?php echo $MSG_SCHOOL ?>
      </label>
      <input name="school" placeholder="<?php echo $MSG_SCHOOL ?>" type="text"
        value="<?php echo htmlentities($row['school'], ENT_QUOTES, "UTF-8") ?>">
    </div>
    <div class="field">
      <label for="email">
        <?php echo $MSG_EMAIL ?>*
      </label>
      <input name="email" placeholder="<?php echo $MSG_EMAIL ?>" type="text"
        value="<?php echo htmlentities($row['email'], ENT_QUOTES, "UTF-8") ?>">
    </div>
    <?php if ($OJ_VCODE) { ?>
      <div class="field">
        <label for="email">
          <?php echo $MSG_VCODE ?>*
        </label>
        <input name="vcode" class="form-control" placeholder="<?php echo $MSG_VCODE ?>" type="text">
        <img alt="click to change" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()" height="30px">
      </div>
    <?php } ?>
    <button name="submit" type="submit" class="ui button">
      <?php echo $MSG_SUBMIT; ?>
    </button>
    <button name="submit" type="reset" class="ui button">
      <?php echo $MSG_RESET; ?>
    </button>
  </form>
  <h1>프로필 사진 업로드</h1>
  <div class="ui form">
    <div class="field">
      <input type="file" id="fileInput">
    </div>
    <button onclick="uploadFile()" class="ui button">업로드</button>
  </div>
</div>
<script>
  function uploadFile() {
    const fileInput = document.getElementById('fileInput');

    if (fileInput.files.length > 0) {
      const selectedFile = fileInput.files[0];

      const formData = new FormData();
      formData.append('profileUpload', selectedFile);

      fetch('template/<?php echo $OJ_TEMPLATE ?>/upload_image.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          alert(data); // 업로드 결과 메시지
        })
        .catch(error => {
          alert('업로드 오류:', error);
        });
    } else {
      alert('파일을 선택해주세요.');
    }
  }
</script>

<?php include("template/$OJ_TEMPLATE/footer.php"); ?>