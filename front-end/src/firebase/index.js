// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";
import { getAuth} from 'firebase/auth'

const firebaseConfig = {
  apiKey: "AIzaSyD3FNdBJsVJG_ImoFFpA_z2DCoGN6z7f0I",
  authDomain: "taskapp-18c2d.firebaseapp.com",
  projectId: "taskapp-18c2d",
  storageBucket: "taskapp-18c2d.appspot.com",
  messagingSenderId: "416238284816",
  appId: "1:416238284816:web:1c1bac600ea410bb16da95",
  measurementId: "G-WE7Z3J2RVY"
};


// Initialize Firebase
initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
export const auth = getAuth();