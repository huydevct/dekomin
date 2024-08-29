<template>
    <div>
        <button
            type="button"
            class="btn px-0 "
            data-coreui-toggle="modal"
            :data-coreui-target="`#modalVideo_${index}`"
        >
            <CIcon :icon="cilMediaPlay" size="xl" />
        </button>
        <div
            class="modal fade"
            :id="`modalVideo_${index}`"
            data-coreui-keyboard="false"
            tabindex="-1"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title text-black"
                            id="staticBackdropLabel"
                        >
                            {{ title }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-coreui-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <video
                            :src="path"
                            class="object-fit-contain mw-100"
                            controls
                        ></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { CIcon } from '@coreui/icons-vue';
import { cilMediaPlay } from '@coreui/icons';
export default {
    name: "VideoModal",
    props: {
        path: {
            type: String,
            require: true,
        },
        title: {
            type: String,
            default: "Video",
        },
        index: {
            type:Number
        },
    },
    components:{
        CIcon
    },
    data(){
        return{
            cilMediaPlay
        }
    }
};
</script>

<style></style>
