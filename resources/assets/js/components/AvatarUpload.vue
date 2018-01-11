<template>
    <div>
        <div class="form-group" :class="{ 'has-error': errors.errors }">
            <label class="control-label">Avatar</label>
            <div v-if="uploading">Processing</div>
            <input v-else type="file" name="image" @change="fileChange">

            <div v-if="errors.errors">
                <span class="has-errors" v-for="x in errors.errors">
                    {{ x[0] }}
                </span>
            </div>
        </div>

        <div v-if="avatar.path">
            <input type="hidden" name="avatar_id" :value="avatar.id">
            <img class="avatar" :src="avatar.path" alt="Current avatar">
        </div>
    </div>
</template>

<style>
    .has-errors {
        color: #a94442;
        line-height: 30px;
    }
</style>

<script>
    export default {
        props: ['currentAvatar'],
        data () {
            return {
                uploading: false,
                errors: [],
                avatar: {
                    id: null,
                    path: this.currentAvatar
                }
            }
        },
        methods: {
            fileChange(e) {
                let fileData = new FormData();
                fileData.append('image', e.target.files[0]);

                axios.post('/post/avatar', fileData).then((response) => {
                    this.uploading = false;
                    this.avatar = response.data.data;
                }).catch((error) => {
                    this.uploading = false;
                    console.log('Got errors...');
                    if (error.response.status === 422) {
                        this.errors = error.response.data;
                        return
                    }
                    this.errors = 'Something went wrong. Try again.';
                })
            }
        }
    }
</script>