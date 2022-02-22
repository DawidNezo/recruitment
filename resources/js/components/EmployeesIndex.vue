<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="align-content-end">
                    <router-link :to="{ name: 'employees.create' }" class="btn btn-success">Create</router-link>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Restaurants</th>
                            <th>Edit</th>
                            <th>Assign restaurants</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="item in employees" :key="item.id">
                            <tr>
                                <td>{{ item.name }}</td>
                                <td>{{ item.surname }}</td>
                                <td>{{ item.email }}</td>
                                <td>
                                    <template v-for="restaurant in item.restaurants">
                                        {{ restaurant.display_name }},
                                    </template>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'employees.edit', params: { id: item.id } }" class="btn btn-primary">Edit</router-link>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'employees.assign.restaurant', params: { id: item.id } }" class="btn btn-primary">Assign</router-link>
                                </td>
                                <td>
                                    <button class="btn btn-danger" @click="deleteEmployee(item.id)">Delete</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import useEmployees from "../composables/employees";
    import { onMounted } from "vue";

    export default {
        setup() {
            const { employees, getEmployees, destroyEmployee } = useEmployees()

            const deleteEmployee = async (id) => {
                if(!window.confirm("Are you sure?")) {
                    return
                }
                await destroyEmployee(id)
                await getEmployees()
            }

            onMounted(getEmployees)

            return {
                employees,
                deleteEmployee
            }
        }
    }
</script>
