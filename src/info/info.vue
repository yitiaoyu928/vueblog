<template>
    <div class='info-root'>
        <div class='info-body'>
            <div class='info-text'>
                <h3 class='info-text-title'>{{article.article_title}}</h3>
                <p class='info-text-p'>{{article.article_text}}</p>
                <div class="info-text-img-roll">
                    <img src="https://cdn.pixabay.com/photo/2020/12/19/03/27/person-5843476_960_720.jpg" alt="图片数据" class="info-text-img" @click='imgShow($event)'>
                </div>
            </div>
            <div class="img-box">
                <transition name='masker-ts'>
                    <div class="big-img" v-if='masker' @click='maskerClose'>
                        <div class="big-img-close">
                            <i class="icon bs i-close close-btn"></i>
                        </div>
                        <img src="https://cdn.pixabay.com/photo/2020/12/19/03/27/person-5843476_960_720.jpg" class="big-img-data">
                    </div>
                </transition>
            </div>
        </div>
        <div class='info-dialog-msg'>
            <dialog-data :dialog-view='userLeave' />
        </div>
        <div class='info-dialog'>
            <my-dialog />
        </div>
    </div>
</template>
<script>
import dialogData from '../dialogdata/dialogdata.vue';
export default {
    data() {
        return {
            masker: false,
            userLeave: [],
            article:{}
        }
    },
    components: {
        'dialog-data': dialogData
    },
    created() {
        this.getDataList();
        this.getArticleList();
    },
    methods: {
        imgShow(e) {
            this.masker = true;
        },
        maskerClose() {
            this.masker = false;
        },
        getDataList() {
           this.$axios.get('http://localhost/dialogData.php', {
                params: {
                    id: this.$route.params.id
                }
            }).then(data => {
                if(data.data === -1) {
                    return;
                }
                data.data.forEach(item=>{
                    this.userLeave.push(item);
                })
            })
        },
        getArticleList() {
            this.$axios.get('http://localhost/get_article_detail.php',{
                params:{
                    articleId:this.$route.params.id
                }
            }).then(data=>{
                this.article = data.data;
            })
        }
    }
}
</script>
<style lang='scss' scoped>
.info-root {
    padding: 10px;

    .info-body {
        min-height: 100vh;

        .info-text {
            .info-text-title {
                text-align: center;
            }

            .info-text-p {
                overflow: hidden;
                word-wrap: break-word;
            }

            .info-text-img-roll {
                text-align: center;

                .info-text-img {
                    width: 100%;
                }
            }

        }

        .big-img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            text-align: center;

            .big-img-close {
                text-align: right;
                padding-top: 10px;

                .close-btn {
                    padding: 10px;
                    font-size: 1.5rem;
                }
            }

            .big-img-data {
                width: 100%;
                position: relative;
                top: 10%;
            }
        }

    }

    .masker-ts-enter,
    .masker-ts-leave-to {
        opacity: 0;
        transform: scale(0);
    }

    .masker-ts-enter-active,
    .masker-ts-leave-active {
        transition: all 0.5s;
    }
}
</style>