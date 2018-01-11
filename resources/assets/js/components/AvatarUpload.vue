<template>
    <div>
        <div class="form-group" :class="{ 'has-error': errors.errors }">
            <label :for="sendAs" class="control-label">Avatar</label>
            <div v-if="uploading">Processing</div>
            <input v-else type="file" v-on:change="fileChange" :name="sendAs">

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
    import upload from '../mixins/upload';

    export default {
        props: ['currentAvatar'],
        data () {
            return {
                errors: [],
                avatar: {
                    id: null,
                    path: this.currentAvatar
                }
            }
        },
        mixins: [upload],
        methods: {
            fileChange(e) {
                this.upload(e).then((response) => {
                    this.avatar = response.data.data;
                }).catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data;
                        return
                    }

                    this.errors = 'Something went wrong. Try again.'
                });
            }
        }
    }
</script>