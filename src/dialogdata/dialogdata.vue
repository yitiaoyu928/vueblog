<template>
	<div class="dialog-data-root">
		<ul class="dialog-data-ul">
			<li v-for='item in dialogView' class="dialog-data-li">
				<div class="dialog-user-pic"></div>
				<div class="dialog-user-message">
					<h3 class="dialog-user-message-nick">{{item.nick}}:</h3>
						<p class="dialog-user-message-text">
							{{item.gust_message}}
						</p>
						<div class="dialog-user-time">{{item.leave_time}}</div>
				</div>
				<div class="clearfix"></div>
			</li>
		</ul>
	</div>
</template>
<script>
	export default {
		props:{
			dialogView:{
				type:Array,
				default:function() {
					return [];
				}
			}
		},
		mounted() {
		}
	}
</script>
<style lang="scss" scoped>
	.dialog-data-root {
		.dialog-data-ul {
			.dialog-data-li {
				border-bottom: 1px solid #666;
				padding: 5px 0;
					&:last-child {
						border-bottom:none;
					}
				.dialog-user-pic {
					width: 2rem;
					height: 2rem;
					border-radius: 50%;
					border:1px solid #ccc;
					box-shadow: 0 0 3px #666;
					float: left;
					margin-top: 5px;
					margin-right: 5px;
				}
				.dialog-user-message {
					position: relative;
					margin-left: 2rem;
					.dialog-user-message-text {
						color: #374045;
					}
					.dialog-user-time {
						text-align: right;
					}
				}
			}
		}
	}
</style>