// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
/* eslint-disable */
import { getAuth, signInWithEmailAndPassword, onAuthStateChanged, signOut } from "firebase/auth";

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
export const auth = getAuth();

export function getCurrentUser() {
  return new Promise((resolve, reject) => {
    const unsubscribe = onAuthStateChanged(auth, (user) => {
      unsubscribe();
      resolve(user);
    }, reject);
  });
};

export async function login() {
  await signInWithEmailAndPassword(auth, 'user@mail.com', 'password')
}

export async function logout() {
  await signOut(auth)
}