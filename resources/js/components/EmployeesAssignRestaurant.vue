<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row" v-if="errors !== ''">
                    {{ errors }}
                </div>

                <form @submit.prevent="saveEmployee">
                    <label for="restaurants">Restaurants </label>
                    <select class="form-select"
                        v-model="employee.restaurant_ids"
                        :multiple="true"
                        :id="restaurant_ids"
                        :name="restaurant_ids">
                        <option v-for="item in assignableRestaurants" :value="item.id">{{ item.display_name }}</option>
                    </select>
                    <hr>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import useEmployees from "../composables/employees";
    import { onMounted } from "vue";
    import Multiselect from '@vueform/multiselect'

    export default {
        props: {
            id: {
                required: true,
                type: String
            }
        },
        setup(props) {
            const { errors, employee, assignableRestaurants, assignRestaurant, getEmployee, getAssignableRestaurants } = useEmployees()

            onMounted(() => getEmployee(props.id))
            onMounted(() => getAssignableRestaurants(props.id))

            const saveEmployee = async () => {
                await assignRestaurant(props.id)
            }

            return {
                errors,
                employee,
                assignableRestaurants,
                saveEmployee
            }
        },
    }
</script>
