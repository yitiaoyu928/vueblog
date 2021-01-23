<template>
    <div class="user-form">
        <h3 class="user-title">
            <span>用户登录</span>
            <router-link to="/regist" class="user-regist">用户注册&gt;</router-link>
        </h3>
        <form action="#" method="post" enctype="application/x-www-form-urlencoded" autocomplete="off" id="user-login" class="user-login">
            <div class="user-input">
                <div class="username-style">
                    <label for="username">
                        <span class="user-text">用户名:</span>
                        <input type="text" name="username" id="username" class="username-input" placeholder="请输入用户名" v-model='username' />
                        <div :class="['hint',[uservalidate?'hint-safety-color':'hint-error-color']]">{{usernamehint}}</div>
                    </label>
                </div>
                <div class="password-style">
                    <label for="password">
                        <span class="user-text">密&nbsp;&nbsp;&nbsp;码:</span>
                        <input type="password" name="password" id="password" class="password-input" placeholder="请输入密码" v-model='password' />
                        <div :class="['hint',[passvalidate?'hint-safety-color':'hint-error-color']]">{{passwordhint}}</div>
                    </label>
                </div>
                <div class="user-action">
                    <div class="user-remember">
                        <div class="remember" @click='checkToggle'><input type="checkbox" name="remeber" value="1" class="user-checkbox" v-model='checkbox' hidden /><i :class="['icon', 'bs', 'i-normal',[checkbox?' i-check-box-on':' i-check-box-off']]"></i><span>记住用户</span></div>
                    </div>
                    <div class="user-submit">
                        <input type="submit" value="用户登录" name="login" class="submit" @click.prevent='submitForm'>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            username: 'yy123456',
            usernamehint: '用户名是以字母A-Z|a-z开头的6到16位数字、字母组合',
            uservalidate: true,
            password: '',
            passwordhint: '密码是6到16位数字、字母组合',
            passvalidate: true,
            checkbox: false
        }
    },
    created() {
        if (sessionStorage.getItem('qgy_user')) {
            this.$router.push('/home');
        }
    },
    methods: {
        checkToggle() {
            this.checkbox = !this.checkbox;
        },
        submitForm() {
            if (this.validateUserName(this.username)) {
                this.usernamehint = '恭喜你，此账号可以使用';
                this.uservalidate = true;
            } else {
                this.usernamehint = '惨了，用户名格式好像不太对！';
                this.uservalidate = false;
                return;
            }
            if (this.validateUserPass(this.password)) {
                this.passwordhint = '密码通过校验';
                this.passvalidate = true;
            } else {
                this.passwordhint = '密码似乎不对哦~';
                this.passvalidate = false;
                return;
            }
            if (this.uservalidate && this.passvalidate) {
                this.$axios.post('http://localhost/login.php',
                    this.$qs.stringify({
                        username: this.username,
                        password: this.password,
                        remember: this.checkbox,
                        login: true

                    })
                ).then(data => {
                    console.log(data)
                    if(typeof data.data !== 'object') {
                        alert('数据返回错误');
                        return ;
                    }
                    this.$store.state.userInfo = data.data;
                    sessionStorage.setItem('qgy_user', JSON.stringify(data.data));
                    this.$router.push('/home');
                })
            }
        },
        validateUserName(val) {
            let pattern = /^[a-zA-Z][0-9a-zA-Z]{6,16}$/g;
            return pattern.test(val);
        },
        validateUserPass(val) {
            let pattern = /^[0-9a-zA-Z]{6,16}$/g;
            return pattern.test(val);
        }

    }
}
</script>
<style lang="scss" scoped>
.user-form {
    min-width: 15rem;
    max-width: 11.3rem;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-shadow: 0px 0px 5px #ccc;
    background-image: linear-gradient(45deg, #fcf8ec 30%, #d0e8f2 40%, #fcf8ec 100%);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    .user-title {
        font-size: 1rem;
        text-align: center;
        color: #433d3c;
        margin: 5px 0;
        position: relative;

        .user-regist {
            position: absolute;
            right: 10px;
            bottom: -0.75rem;
            z-index: 5;
            font-size: 0.6rem;
            color: #222831;

            &:active {
                color: #707070;
                -webkit-tap-highlight-color: transparent;
            }
        }
    }

    .username-style,
    .password-style {
        padding: 0.75rem 0;
        text-align: center;
        position: relative;

        .hint {
            font-size: 0.5rem;
            height: 1.5rem;
            line-height: 1.5rem;
        }

        .hint-safety-color {
            color: #16c79a;
        }

        .hint-error-color {
            color: #ef4f4f;
        }

    }

    .username-input,
    .password-input {
        height: 1rem;
        width: 8rem;
        font-size: 0.5rem;
        border: none;
        border-bottom: 1px solid #ccc;
        outline: none;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .username-input:focus,
    .password-input:focus {
        border-bottom: 1px solid #456268;
    }

    .user-action {
        border-top: 1px solid #ccc;
        padding: 0.5rem;

        .user-remember {
            padding-left: 2rem;
            padding-bottom: 0.5rem;
        }

        .remember {
            .i-normal {
                vertical-align: middle;
                font-size: 0.7rem;
            }

            span {
                margin-left: 5px;
                vertical-align: middle;
                font-size: 0.7rem;
                cursor: default;
            }
        }

        .user-submit {
            text-align: center;
        }

        .submit {
            font-size: 0.7rem;
            padding: 0.4rem 1.5rem;
            border: none;
            background-color: #65d6ce;
            border-radius: 2px;
            color: #825959;
            box-shadow: 0px 0px 5px #fff3b2;
        }
    }
}
</style>