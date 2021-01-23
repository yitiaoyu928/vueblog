<template>
  <div class="aside-info">
    <div class="aside-info-head-pic">
      <img :src="userInfo.user_pic" class="head_img" />
    </div>
    <div class="aside-user-info">
      <h3 class="aside-user-nick">
        <span class="aside-user-nick-span">{{ userInfo.nick }}</span>
        <ul class="aside-user-nick-ul">
          <li class="aside-user-nick-li" @click="loginOut">退出</li>
        </ul>
      </h3>
      <div class="aside-user-level">等级:{{ userInfo.user_level }}</div>
      <div class="clearfix"></div>
    </div>
    <div class="aside-user-search">
      <input
        type="text"
        class="aside-search-input"
        placeholder="来搜索一下吧"
        v-model="searchVal"
      /><button class="aside-search-button" @click="searchContent">搜索</button>
    </div>
    <div class="aside-user-detail-info">
      <ul class="user-detail-ul">
        <li class="user-detail-li">
          <span>用户账号：</span><span>{{ userInfo.username }}</span>
        </li>
        <li class="user-detail-li">
          <span>上次登录时间：</span><span>{{ userInfo.login_at }}</span>
        </li>
        <li class="user-detail-li">
          <span>留言数量：</span><span>{{ userInfo.message_num }}</span
          >条
        </li>
        <li class="user-detail-li">
          <span>登录IP：</span><span>{{ userInfo.login_ip }}</span>
        </li>
      </ul>
    </div>
    <div class="aside-user-change">
      <div class="aside-user-change-means">
        <span class="aside-user-change-means-span" @click="editInfo"
          ><router-link to='/home/editInfo'><i class="icon bs i-alter"></i>修改资料</router-link></span
        >
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="aside-user-change-means-span"
          ><a href="#">前往聊天</a></span
        >
      </div>
    </div>
  </div>
</template>
<script>
import changePic from "../changePic/changePic.vue";
export default {
  data() {
    return {
      userInfo: {},
      nick: "",
      searchVal: "",
    };
  },
  created() {
    if (!sessionStorage.getItem("qgy_user")) {
      this.$router.push("/login");
    } else {
      this.$store.state.userInfo = JSON.parse(
        sessionStorage.getItem("qgy_user")
      );
      this.userInfo = this.$store.state.userInfo;
      this.nick = this.userInfo.nick;
    }
  },
  methods: {
    loginOut() {
      sessionStorage.clear();
      this.$router.push("/login");
    },
    editInfo() {
      this.editbool = !this.editbool;
    },
    
    searchContent() {
      let pattern = /\s/g;
      this.serachVal = this.searchVal.replace(pattern, "");
    },
  }
};
</script>
<style lang="scss" scoped>
.aside-info {
  max-height: 400px;
  position: relative;
  max-width: 7rem;
  min-height: 7rem;
  border: 1px solid #ccc;
  box-shadow: 0 0 5px #ccc;
  background-image: repeating-linear-gradient(45deg, #ffb26b, #ffd56b);
  border-radius: 5px;

  .aside-info-head-pic {
    width: 25%;
    height: 25%;
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 3px solid #ccc;
    border-radius: 50%;
    background-color: #fff;
    overflow: hidden;


    .head_img {
      width: 100%;
      height: 100%;
    }
  }

  .aside-user-info {
    margin-bottom: 5px;
    font-size: 0.5rem;

    .aside-user-nick {
      float: left;
      padding: 3px 10px;
      font-weight: normal;
      position: relative;
      width: 2rem;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;

      &:hover .aside-user-nick-ul {
        opacity: 1;
      }

      .aside-user-nick-span {
        font-size: 0.2rem;
      }

      .aside-user-nick-ul {
        cursor: pointer;
        position: absolute;
        top: 2px;
        left: 0;
        opacity: 0;
        width: 100%;
        color: #00917c;
        background-image: linear-gradient(45deg, #f8ed86, #feffa0);
        text-align: center;
        border-radius: 15px;
        transition: opacity 0.3s;
      }
    }

    .aside-user-level {
      float: right;
      padding: 3px 10px;
    }
  }

  .aside-user-search {
    padding-top: 10px;
    padding-left: 5px;

    .aside-search-input {
      vertical-align: top;
      font-size: 0.3rem;
      width: 4rem;
      height: 1.1rem;
      outline: none;
      border: none;
      border: 1px solid #666;
      border-right: none;
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
      overflow: hidden;
      transition: all 0.3s;

      &:focus {
        border: 1px solid #74c7b8;
        border-right: none;
      }
    }

    .aside-search-button {
      vertical-align: top;
      font-size: 0.4rem;
      width: 1.4rem;
      height: 1.4rem;
      font-weight: 700;
      color: #222831;
      border: none;
      border: 1px solid #666;
      border-left: none;
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
      cursor: pointer;
      outline: none;
      background-color: #f5f4f4;

      &:active {
        background-color: #99a8b2;
      }
    }
  }

  .aside-user-detail-info {
    .user-detail-ul {
      .user-detail-li {
        text-align: left;
        padding: 0.2rem;
        font-size: 0.3rem;
      }
    }
  }

  .aside-user-change {
    text-align: center;

    .aside-user-change-means {
      .aside-user-change-means-span {
        font-size: 0.5rem;

        > a {
          font-size: 0.5rem;
          color: #433d3c;

          &:hover {
            text-decoration: underline;
            color: #939b62;
          }
        }
      }
    }
  }

  .user-info-change-opeartion {
    background-color: #f5f4f4;
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 5px;
    width: 100%;
    height: 100%;

    .user-info-change-box {
      position: relative;
      top: 50%;
      transform: translateY(-50%);

      .change-title {
        font-size: 1rem;
        color: #374045;
        text-align: center;
      }

      .user-info-change-style {
        vertical-align: middle;
        font-size: 0.4rem;
      }

      .user-info-change-submit {
        height: 2rem;

        button {
          font-size: 0.4rem;
          margin-top: 0.3rem;
          padding: 10px 20px;
          border: none;
          color: #eee;
          font-weight: 600;
          border-radius: 5px;
          background-color: #0e49b5;
          transition: 0.5s;
          border: 1px solid #0e49b5;
          box-shadow: 0 1px 5px #f5f4f4;
          overflow: hidden;

          &:hover {
            background-color: transparent;
            color: #0e49b5;
            border: 1px solid #0e49b5;
          }
        }
      }

      input {
        vertical-align: middle;
        font-size: 0.3rem;
        width: 5rem;
        height: 0.7rem;
        margin: 5px 0;
      }
    }
  }
}
</style>