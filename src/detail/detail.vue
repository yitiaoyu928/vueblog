<template>
    <div class="detail">
        <div class="user-info xs-hidden md-hidden">
            <id-card />
        </div>
        <div class="user-detail xs-position-zero md-position-zero">
            <div class="detail-head" v-for='(item,index) in dataList'>
                <h3 class="detail-info-title">{{item.article_title}}</h3>
                <div class="detail-info">
                    <span class="detail-info-issue-date">{{item.article_time | formatDate}}</span>&nbsp;&nbsp;|&nbsp;&nbsp;<span class="detail-info-issue-class">{{item.article_classify}}</span>
                </div>
                <div class="detail-info-part">{{item.article_content}}</div>
                <div class="detail-reader-all">
                    <router-link :to='"/home/info/"+item.id' class='link'><i class="icon bs i-edit icon_edit"></i>阅读全文</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            dataList:[]
        }
    },
    methods: {
        getArticleList() {
            this.$axios.get('http://localhost/get_article_list.php',{
                params:{
                    classify:this.$route.path
                }
            }).then(data=>{
                this.dataList = data.data;
            });
        }
    },
    created() {
       this.getArticleList();
    },
    filters:{
        formatDate(val) {
           return val.split(/\s/)[0];
        }
    }
}
</script>
<style lang="scss" scoped>
.detail {
    margin-top: 0.5rem;
    text-align: center;
    padding-bottom: 2rem;
    min-height: 100vh;
    .user-info {
        position: absolute;
        top: 1rem;
        min-width: 400px;
        text-align: center;
    }
    .user-detail {
        margin-left: 400px;
        padding-right: 10px;
    }
    .detail-head {
        cursor: default;
        padding: 20px 0;
        border-radius: 3px;
        transition: all 0.3s;

        &:hover {
            box-shadow: 0 1px 5px #30475e;
        }

        .detail-info-title {
            &:hover {
                text-decoration: underline;
            }
        }

        .detail-info {
            vertical-align: middle;

            .detail-info-issue-date,
            .detail-info-issue-class {
                font-size: 0.7rem;
            }
        }

        .detail-info-part {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            white-space: normal !important;
            word-wrap: break-word;

            &:hover {
                text-decoration: underline;
            }
        }

        .detail-reader-all {
            .link {
                &:hover {
                    text-decoration: underline;
                }

                .icon_edit {
                    font-size: 1rem;
                }
            }
        }
    }

}
</style>