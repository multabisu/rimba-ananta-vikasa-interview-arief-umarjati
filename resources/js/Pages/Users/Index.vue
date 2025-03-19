<template>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Users Management</h4>
        <button class="btn btn-primary" @click="showAddModal">Add New User</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.age }}</td>
                <td>
                  <button class="btn btn-sm btn-info me-2" @click="editUser(user)">Edit</button>
                  <button class="btn btn-sm btn-danger" @click="deleteUser(user.id)">Delete</button>
                </td>
              </tr>
              <tr v-if="users.length === 0">
                <td colspan="5" class="text-center">No users found</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditing ? 'Edit User' : 'Add New User' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitForm">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" v-model="form.name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" v-model="form.email" required>
              </div>
              <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" v-model="form.age">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">{{ isEditing ? 'Update' : 'Save' }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';

export default {
  setup() {
    const users = ref([]);
    const form = ref({
      id: '',
      name: '',
      email: '',
      age: null
    });
    const isEditing = ref(false);
    let modal = null;

    onMounted(() => {
      fetchUsers();
      modal = new bootstrap.Modal(document.getElementById('userModal'));
    });

    const fetchUsers = async () => {
      try {
        const response = await axios.get('/api/users');
        users.value = response.data.data;
      } catch (error) {
        console.error('Error fetching users:', error);
        alert('Failed to load users');
      }
    };

    const showAddModal = () => {
      resetForm();
      isEditing.value = false;
      modal.show();
    };

    const editUser = (user) => {
      form.value = { ...user };
      isEditing.value = true;
      modal.show();
    };

    const resetForm = () => {
      form.value = {
        id: '',
        name: '',
        email: '',
        age: null
      };
    };

    const submitForm = async () => {
      try {
        if (isEditing.value) {
          await axios.put(`/api/users/${form.value.id}`, form.value);
          alert('User updated successfully');
        } else {
          await axios.post('/api/users', form.value);
          alert('User added successfully');
        }
        modal.hide();
        fetchUsers();
        resetForm();
      } catch (error) {
        console.error('Error submitting form:', error);
        alert('Error saving user data');
      }
    };

    const deleteUser = async (id) => {
      if (confirm('Are you sure you want to delete this user?')) {
        try {
          await axios.delete(`/api/users/${id}`);
          alert('User deleted successfully');
          fetchUsers();
        } catch (error) {
          console.error('Error deleting user:', error);
          alert('Error deleting user');
        }
      }
    };

    return {
      users,
      form,
      isEditing,
      showAddModal,
      editUser,
      submitForm,
      deleteUser
    };
  }
}
</script>