package es.garchypielago.dwes.ejercicio07.beans;

import org.springframework.boot.CommandLineRunner;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

//con prototype eso quito el singleton
@Component
@Scope("prototype")
public class Contador {

    private int numero;

    public Contador() {
        this.numero = 0;
    }

    public int getNumero() {
        return numero;
    }

    public void sumar() {
        numero++;
    }

    public void restar() {
        numero--;
    }
}
