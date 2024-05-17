import axiosInstance from './axiosInstance';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from 'firebase/auth';
import { auth } from '../firebase';

const headers = {
  'Authorization': `Bearer ${localStorage.getItem('token')}`
};

class UserService {

  login(email, password) {
    return axiosInstance.post('/login', {
      email: email,
      password: password
    });
  }
  async authenticateWithFirebase(email, password, router) {
    try {
      await createUserWithEmailAndPassword(auth, email, password);
      router.replace('/tasks');
      return true; 
    } catch (error) {
      if (error.code === 'auth/email-already-in-use') {
        await this.signInFirebase(email, password, router);
        return true; 
      } else {
        console.error(error.message);
        return false; 
      }
    }
  }
  
  async signInFirebase(email, password, router) {
    const auth = getAuth();
    signInWithEmailAndPassword(auth, email, password)
      .then(() => {
        router.replace('/tasks'); 

      })
      .catch((error) => {
        console.error(error,);
      });

  }
  async logout() {
    auth.signOut().then(() => {
      console.log('removendo token')
      localStorage.removeItem('token');

    }).catch(error => {
      console.error(error);
    });

  }


  async me() {
    return axiosInstance.get('/me', { headers });
  }

}

export default new UserService();
