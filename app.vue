<template>
    <div class="root">
        <transition name="transition-rl">
            <router-view></router-view>
        </transition>
    </div>
</template>
<script>
export default {
    created() {
        if(!sessionStorage.getItem('qgy_user')) {
            this.$router.push('/login');
        }
    }
}
</script>
<style lang="scss" scoped>
.root {
    overflow: hidden;
    padding: 0 30px;
}

.transition-rl-enter,
.transition-rl-leave-to {
    opacity: 0;
}

.transition-rl-enter-active,
.transition-rl-leave-active {
    transition: all 0.5s;
}
</style>