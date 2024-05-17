import axiosInstance from './axiosInstance';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from 'firebase/auth';
import { auth } from '../firebase';


class APIClient {

  login(email, password) {
    return axiosInstance.post('/login', {
      email: email,
      password: password
    });
  }

  async authenticateWithFirebase(email, password) {

    createUserWithEmailAndPassword(auth, email, password)
      .then(() => { })
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
      .then(() => {})
      .catch((error) => {
        console.error(error,);
      });

  }
  async logout() {
    auth.signOut().then(() => {
    }).catch(error => {
      console.error(error);
    });

  }




}

export default new APIClient();
