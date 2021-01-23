<template>
    <div class="home">
        <div class="container">
            <nav-bar></nav-bar>
        </div>
        <div class="container">
            <transition name='home-transition'>
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>
<script>
export default {
    created() {
    }
}
</script>
<style lang="scss" scoped>
.home {
    overflow: hidden;

    .container {
        position: relative;
        .home-transition-enter,.home-transition-leave-to {
            transform:translateX(-100%);
            position: absolute;
            opacity: 0;
        }
        .home-transition-enter-active,.home-transition-leave-active {
            transition: all 0.3s;
        }
        .user-card {
            min-width: 400px;
            position: absolute;
            top: 1rem;
        }

        .user-detail {
            position: relative;
            margin-left: 8rem;
        }
    }
}
</style>