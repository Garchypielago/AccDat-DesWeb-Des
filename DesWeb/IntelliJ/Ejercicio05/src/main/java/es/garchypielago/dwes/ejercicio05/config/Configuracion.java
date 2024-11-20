package es.garchypielago.dwes.ejercicio05.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import java.util.Comparator;

@Configuration
public class Configuracion {
    @Bean
    public Comparator<String> comparadorPorLongitud() {
        return new Comparator<String>() {
            @Override
            public int compare(String o1, String o2) {
                return o1.length() - o2.length();
            }
        };
    }
}
