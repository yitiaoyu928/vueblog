<template>
  <div class="change-pic">
    <h5 class="title"><span class="new-mimesis-title">修改用户头像</span></h5>
    <div class="user-img" ref="userImg"></div>
    <form>
      <input
        type="file"
        hidden
        name="user-pic"
        ref="inp"
        accept="image/png,image/jpg,image/jpeg"
      />
    </form>
    <button class="new-mimesis-button" @click="selectFile">选择文件</button>
    <button class="new-mimesis-button" @click="postPic">更新头像</button>
  </div>
</template>
<script>
export default {
  created() {

  },
  data() {
      return {
      }
  },
  methods: {
    // 关闭
    postPic() {
        let forms = new FormData();
        forms.append('file',this.$refs.inp.files[0]);
        forms.append('id',JSON.parse(sessionStorage.getItem('qgy_user')).id)
        this.$axios.post('http://localhost/change_pic.php',forms).then(data=>{
          console.log(data.data)
          if(Object.prototype.toString.call(data.data) === '[object Object]') {
            sessionStorage.setItem('qgy_user',JSON.stringify(data.data));
            this.$router.push('/');
            alert('修改成功');
          }
            
        })
    },
    selectFile(e) {
      this.$refs.inp.click();
      let _this = this;
      this.$refs.inp.addEventListener("change", function (e) {
        if (_this.getImageSize(this.files[0])) {
          alert("选择图片过大,请重新选择");
          return;
        }
        _this.$refs.userImg.style.backgroundImage =
          "url(" + _this.getImageRealPath(this.files[0]) + ")";
      });
    },
    // 获取图片路径
    getImageRealPath(file) {
      let url = null;
      if (window.createObjectURL != undefined) {
        url = window.createObjectURL(file);
      } else if (window.URL != undefined) {
        url = window.URL.createObjectURL(file);
      } else {
        url = window.webkitURL.createObjectURL(file);
      }
      return url;
    },
    getImageSize(file, maxSize = 2097152) {
      return file.size > maxSize ? true : false;
    },
  },
};
</script>
<style lang="scss" scoped>
.change-pic {
    margin-top:1rem;
    .title {
        text-align: center;
    }
  .user-img {
    width: 5rem;
    height: 5rem;
    border-radius: 10px;
    margin: 2.5rem auto;
    background: linear-gradient(225deg, #b9b9bb, #dbdcdf);
    box-shadow: -19px 19px 38px #5c5d5e, 19px -19px 38px #ffffff;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  .select-pic-button {
    font-size: 0.4rem;
    margin-top: 0.3rem;
    padding: 10px 20px;
    border: none;
    color: #eee;
    font-weight: 600;
    border-radius: 5px;
    transition: 0.5s;
  }
}
</style>