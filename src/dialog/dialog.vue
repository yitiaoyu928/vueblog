<template>
	<div class='dialog-root'>
		<h3 class="dialog-title">发布意见</h3>
		<form>
		<div class="dialog-ele">
			<textarea name='dialog' class="dialog" v-model='leaveWord'></textarea>
		</div>
		<div class="dialog-button">
			<button type="button" class="send-message" @click.prevent='postLeave'>留言</button>
		</div>
	</form>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				leaveWord:''
			}
		},
		methods:{
			// 提交留言
			postLeave() {
				let user_nick = JSON.parse(sessionStorage.getItem('qgy_user')).nick;
				this.$axios.post('http://localhost/dialog.php',this.$qs.stringify({
					id:this.$route.params.id,
					gust_message:this.leaveWord,
					nick:user_nick,
					u_id:JSON.parse(sessionStorage.getItem('qgy_user')).id,
					message_num:parseInt(JSON.parse(sessionStorage.getItem('qgy_user')).message_num)
				})).then(data=>{
					let res = data.data;
					console.log(res);
					console.log(res['message_num']);
					let sessionMessage_number = res['message_num'];
					this.updateSession(sessionMessage_number);
					if(typeof res === 'object') {
						this.leaveWord = '';
						this.$router.go(0)
						alert('发表成功');
					}else {
						alert('发表失败');
					}
				})
			},
			// 更新session
			updateSession(val) {
				// 取出session中的session
				let session = JSON.parse(sessionStorage.getItem('qgy_user'));
				session['message_num'] = val;
				sessionStorage.setItem('qgy_user',JSON.stringify(session));
			}
		},
		created() {
		}

	}
</script>
<style lang='scss' scoped>
	.dialog-root {
		padding:20px 0;
		.dialog-title {
			font-size: 0.7rem;
			text-align: left;
		}
		.dialog-ele {
			padding: 10px 0 0 0;
			.dialog {
				width: 100%;
				margin: 0 auto;
				height: 3rem;
				font-size: 0.5rem;
				resize: none;
				border-radius: 5px;
			}
		}
		.dialog-button {
			text-align: right;
			.send-message {
				padding: 0.4rem 2rem;
				border: none;
				background-color:#0e49b5;
				color: #f5f4f4;
				border-radius: 5px;
				border: 1px solid #0e49b5;
				box-shadow: 0 0 3px #666;
				transition: all 0.5s;
				&:hover {
					background-color:#f5f4f4;
					color: #0e49b5;
				}
			}
		}
	}
</style>