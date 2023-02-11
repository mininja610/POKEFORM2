<template>
    <div>
        <input
            type="text"
            v-model="query"
            @input="getSuggestionList"
            Autocomplete="on"
            :list="param"
            placeholder="Please input..."
            class="form-control"
            :name="param"
        />
        <datalist :id="param">
            <option
                v-for="result in results"
                :key="result.id"
                :value="result[param]"
            />
        </datalist>
    </div>
</template>

<script>
export default {
    props: ["param", "url"],
    data() {
        return {
            query: "",
            results: []
        };
    },
    methods: {
        getSuggestionList() {
            this.results = [];
            if (this.query.length > 1) {
                axios
                    .get(this.url, {
                        params: { query: this.query }
                    })
                    .then(Response => {
                        this.results = Response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
};
</script>