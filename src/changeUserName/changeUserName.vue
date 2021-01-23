<template>
  <div>
    <div class="user-info-change-box">
      <h5 class="change-title m-bottom"><span class="new-mimesis-title">修改用户名</span></h5>
      <form enctype="multipart/form-data">
      <div class="inp-margin">
        <label for="nick"
          ><span class="user-info-change-style">昵&nbsp;&nbsp;称:</span
          ><input type="text" name="nick" id="nick" v-model="nick"
        /></label>
        </div>
        <div class="user-info-change-submit">
          <button type="button" @click="editData" class="new-mimesis-button">修改信息</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      nick: "",
    };
  },
  methods: {
    editData() {
      let userObject = JSON.parse(sessionStorage.getItem("qgy_user"));
      let userId = userObject.id;
      this.$axios
        .post(
          "http://localhost/editinfo.php",
          this.$qs.stringify({
            id: userId,
            nick: this.nick,
          })
        )
        .then((data) => {
          // 检测是否返回是一个对象
          if (typeof data.data !== "object") {
            alert('返回数据似乎错了，不要担心，这是服务器问题。请先不要修改用户名');
            return;
          }
          sessionStorage.setItem("qgy_user", JSON.stringify(data.data));
          this.$store.state.userInfo = data.data;
          this.userInfo = this.$store.state.userInfo;
          this.$router.push('/home');
        });
    },
  },
};
</script>
<style lang="scss" scoped>
.user-info-change-box {
  margin-top: 1rem;

  .change-title {
    font-size: 1rem;
    color: #374045;
    text-align: center;
  }

  .user-info-change-style {
    vertical-align: middle;
    font-size: 0.4rem;
  }
  .inp-margin {
      margin: 2.5rem;
  }

  .user-info-change-submit {
    height: 2rem;
  }

  input {
    vertical-align: middle;
    font-size: 0.3rem;
    width: 5rem;
    height: 0.7rem;
    margin: 5px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
}
</style>