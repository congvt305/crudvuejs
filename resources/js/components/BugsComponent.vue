<template>
    <div class="bugs">
        <div class="col-1">
            <img :src="image"/>
        </div>
        <div class="col-2">
            <h3>Name: {{ name | properCase }}</h3>
            <select @change="update">
                <option
                    v-for="col in [ 'red', 'green' ]"
                    :value="col"
                    :key="col"
                    :selected="col === color ? 'selected' : ''"
                >{{ col | properCase }}</option>
            </select>
            <button @click="del">Delete</button>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        image() {
            return `/images/${this.color}.jpg`;
        }
    },
    methods: {
        update(val) {
            this.$emit('update', this.id, val.target.selectedOptions[0].value);
        },
        del() {
            this.$emit('delete', this.id);
        }
    },
    props: ['id', 'color', 'name'],
    filters: {
        properCase(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    }
}
</script>
<style>
.bugs {
    display: flex;
    margin: 1em 1em 1em 0;
    border: 1px solid #d1d1d1;
    padding: 1em;
    max-width: 350px;
    background-color: white;
}
.bugs img {
    width: 50px;
    height: 50px}
.col-2 {
    margin-left: 1em;
}
.col-2 > h3 {
    margin: 0.5em 0;
}
</style>
