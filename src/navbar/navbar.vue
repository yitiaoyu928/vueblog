<template>
    <div class="navbar">
        <div class="navbar-header">
            <div class="navbar-logo xs-hidden  md-hidden">
                <router-link to='/home' class="nav-logo-a">
                    <h1 class="nav-logo-h1 md-clearfix"></h1>
                </router-link>
            </div>
            <div class="navbar-menu xs-center md-center">
                <ul class="nav-menu-ul">
                    <li :class="['nav-menu-li',[this.$route.fullPath==='/home'?'active':'']]">
                        <router-link to='/home' class='nav-link'>随机读读</router-link>
                    </li>
                    <li :class="['nav-menu-li',[this.$route.fullPath==='/home/taste'?'active':'']]">
                        <router-link to='/home/taste' class='nav-link'>浅尝BUG</router-link>
                    </li>
                    <li :class="['nav-menu-li',[this.$route.fullPath==='/home/wishes'?'active':'']]">
                        <router-link to='/home/wishes' class='nav-link'>随笔&技术</router-link>
                    </li>
                    <li :class="['nav-menu-li',[this.$route.fullPath==='/home/timeline'?'active':'']]">
                        <router-link to='/home/timeline' class='nav-link'>时间简史</router-link>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
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
.navbar {

    .navbar-header {
        border-bottom: 1px solid #c9cbff;
        padding-bottom: 0.1rem;
        .navbar-logo {
            float: left;
            margin-top: 0.1rem;
            .nav-logo-h1 {
                padding: 30px 100px;
                background: url(../../public/logo.png) no-repeat center center;
            }
        }

        .navbar-menu {
            float: right;

            .nav-menu-ul {
                .nav-menu-li {
                    vertical-align: top;
                    position: relative;
                    z-index: 50;
                    overflow: hidden;
                    &::after {
                        content: '';
                        display: block;
                        height: 80%;
                        width: 100%;
                        position: absolute;
                        margin-top: 100%;
                        top: 0;
                        left: 0;
                        background-color: rgba(48,71,94,0.5);
                        z-index: -1;
                        transition:all 0.5s;
                        border-radius:5px;
                    }
                    padding: 0.2rem 0.2rem;
                    display: inline-block;
                    &:hover {
                        &::after {
                            margin-top: 0.2rem;
                        }
                    }
                    .nav-link {
                        font-size: 0.7rem;
                        transition: color 0.3s;

                        &:hover {
                            color: #f5f4f4;
                            filter: blur(0px);
                        }

                    }
                }
            }
        }
    }
    .active {
        border-bottom:3px solid rgba(48,71,94,0.5);
    }
}
</style>