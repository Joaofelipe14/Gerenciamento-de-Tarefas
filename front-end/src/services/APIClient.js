import axiosInstance from './axiosInstance';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from 'firebase/auth';
import { auth } from '../firebase';


class APIClient {

  login(email, password) {
    console.log(email, password)
    return axiosInstance.post('/login', {
      email: email,
      password: password
    });
  }

  async authenticateWithFirebase(email, password) {

    console.log('firebase')
    createUserWithEmailAndPassword(auth, email, password)
      .then((credential) => {
        console.log(credential)
        console.log('conta nova criada')
        this.$router.push('/tasks');
      })
      .catch((error) => {
        if (error.code === 'auth/email-already-in-use') {
          this.signInFirebase(email, password);
        } else {
          console.error(error.message);
        }
      })

  }

  async signInFirebase(email, password) {
    const auth = getAuth();
    signInWithEmailAndPassword(auth, email, password)
      .then((userCredential) => {
        console.log(userCredential)
        console.log('logado em conta existe')

        this.$router.push('/tasks');
      })
      .catch((error) => {
        console.error(error,);
      });

  }
  async logout() {
    const response = await axiosInstance.post('/logout');
    return response.data;

  }
}

export default new APIClient();
