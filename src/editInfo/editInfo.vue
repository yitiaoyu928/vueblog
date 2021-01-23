<template>
  <div class="change-root">
    <div class="tab">
      <span class="tab-link" @click="changeTab">修改用户名</span>
      <span class="tab-link" @click="changeTab">修改头像</span>
    </div>
    <div class="change-eidt-mode">
      <transition-group name="fade-in" mode="out-in" tag="div">
          <change-user-name v-show="pic" key="1"/>
          <change-pic v-show="!pic" key="2" />
      </transition-group>
    </div>
  </div>
</template>
<script>
import changeUserName from "../changeUserName/changeUserName.vue";
import changePic from "../changePic/changePic.vue";
export default {
  data() {
    return {
      pic: true,
    };
  },
  methods: {
    changeTab() {
      this.pic = !this.pic;
    },
  },
  components: {
    "change-user-name": changeUserName,
    "change-pic": changePic,
  },
};
</script>
<style lang="scss" scoped>
.change-root {
  height: 100vh;
  .tab {
    margin-top: 1rem;
    text-align: center;
    .tab-link {
      display: inline-block;
      min-width: 5rem;
      text-align: center;
      cursor: pointer;
      user-select: none;
      transition: all 0.3s ease-in;
      &:hover {
        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
      }
    }
  }
  .change-eidt-mode {
    text-align: center;
    .fade-in-enter,
    .fade-in-leave-to {
      opacity: 0;
      position: absolute;
      transform: translateX(-100%);
    }
    .fade-in-enter-active,
    .fade-in-leave-active {
      transition: 0.5s;
    }
  }
}
</style>