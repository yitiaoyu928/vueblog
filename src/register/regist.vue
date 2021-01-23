<template>
    <div class="user-form">
        <h3 class="user-title">
            <span>用户注册</span>
            <router-link to='/login' class="user-regist">已有账号？前去登录&gt;</router-link>
        </h3>
        <form action="#" method="post" enctype="multipart/form-data" autocomplete="off" id="user-login" class="user-login">
            <div class="user-input">
                <div class="username-style">
                    <label for="username">
                        <span class="user-text">用户名:</span>
                        <input type="text" name="username" id="username" class="username-input" placeholder="请输入用户名" v-model='username'>
                        <div :class="['hint',[uservalidate?'hint-safety-color':'hint-error-color']]">{{usernamehint}}</div>
                    </label>
                </div>
                <div class="password-style">
                    <label for="password">
                        <span class="user-text">密&nbsp;&nbsp;&nbsp;码:</span>
                        <input type="password" name="password" id="password" class="password-input" placeholder="请输入密码" v-model='password'/>
                        <div :class="['hint',[passvalidate?'hint-safety-color':'hint-error-color']]">{{passwordhint}}</div>
                    </label>
                </div>
                <div class="email-style">
                    <label for="email">
                        <span class="user-text">邮&nbsp;&nbsp;&nbsp;箱:</span>
                        <input type="text" name="email" id="email" class="email-input" placeholder="请输入邮箱" v-model='email' />
                        <div :class="['hint',[emailvalidate?'hint-safety-color':'hint-error-color']]">{{emailhint}}</div>
                    </label>
                </div>
                <div class="user-action">
                    <div class="user-submit">
                        <input type="submit" value="用户注册" name="regist" class="submit" @click.prevent='submitForm'>
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
            username: '',
            usernamehint: '用户名是以字母A-Z|a-z开头的6到16位数字、字母组合',
            uservalidate: true,
            password: '',
            passwordhint: '密码是6到16位数字、字母组合',
            passvalidate: true,
            email: '',
            emailhint: '邮箱格式：xxxxxx@xxx.com,邮箱可以用于以后找回密码',
            emailvalidate: true

        }
    },
    methods: {
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
            if (this.validateEmail(this.email)) {
                this.emailhint = '恭喜你，此邮箱可以使用';
                this.emailvalidate = true;
            } else {
                this.emailhint = '惨了，邮箱格式好像不太对！';
                this.emailvalidate = false;
                return;
            }
            if(this.uservalidate && this.passvalidate && this.emailvalidate) {
                this.$axios.post("http://localhost/register.php",this.$qs.stringify({
                    username:this.username,
                    password:this.password,
                    email:this.email
                })).then(data=>{
                    console.log(data.data);
                });
            }
        },
        validateUserName(val) {
            let pattern = /^[a-zA-Z][0-9a-zA-Z]{6,16}$/g;
            return pattern.test(val);
        },
        validateUserPass(val) {
            let pattern = /^[0-9a-zA-Z]{6,16}$/g;
            return pattern.test(val);
        },
        validateEmail(val) {
            let pattern = /^[0-9a-zA-Z_]{2,}@[0-9a-zA-Z]{1,13}\.c[com|cn|net]{1,3}$/g;
            return pattern.test(val);
        }
    }
}
</script>
<style lang="scss" scoped>
.user-form {
    min-width: 15rem;
    border: 1px solid #ccc;
    border-radius: 3px;
    max-width: 20rem;
    box-shadow: 0px 0px 5px #ccc;
    background-image: linear-gradient(45deg, #fcf8ec 30%, #d0e8f2 40%, #fcf8ec 100%);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -40%);
    .user-title {
        padding-top: 0.3rem;
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
    .password-style,
    .email-style {
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
    .password-input,
    .email-input {
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
    .password-input:focus,
    .email-input:focus {
        border-bottom: 1px solid #456268;
    }

    .user-action {
        border-top: 1px solid #ccc;
        padding: 0.5rem;

        .user-submit {
            margin-top: 0.75rem;
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