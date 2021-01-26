<template>
    <div id="app">
        <div class="heading">
            <h1>Cruds</h1>
        </div>
        <bugs-component
            v-for="bug in bugs"
            v-bind="bug"
            :key="bug.id"
            @update="update"
            @delete="del"
        ></bugs-component>
        <div>
            <button @click="create">Add</button>
        </div>
    </div>
</template>

<script>
function Bug({ id, color, name}) {
    this.id = id;
    this.color = color;
    this.name = name;
}

import BugsComponent from './components/BugsComponent.vue';

export default {
    data() {
        return {
            bugs: [],
            mute: false
        }
    },
    methods: {
        async create() {
            this.mute = true;
            const { data } = await window.axios.get('/api/bugs/create');
            this.bugs.push(new Bug(data));
            this.mute = false;
        },
        async read() {
            this.mute = true;
            const { data } = await window.axios.get('/api/bugs');
            data.forEach(bug => this.bugs.push(new Bug(bug)));
            this.mute = false;
        },
        async update(id, color) {
            this.mute = true;
            await window.axios.put(`/api/bugs/${id}`, { color });
            this.bugs.find(bug => bug.id === id).color = color;
            this.mute = false;
        },
        async del(id) {
            this.mute = true;
            await window.axios.delete(`/api/bugs/${id}`);
            let index = this.bugs.findIndex(bug => bug.id === id);
            this.bugs.splice(index, 1);
            this.mute = false;
        }
    },
    watch: {
        mute(val) {
            document.getElementById('mute').className = val ? "on" : "";
        }
    },
    components: {
        BugsComponent
    },
    created() {
        this.read();
    }
}
</script>
<style>
#app {
    margin-left: 1em;
}

.heading h1 {
    margin-bottom: 0;
}
</style>
