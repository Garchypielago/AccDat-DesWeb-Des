package es.garchypielago.dwes.ejercicio05.servicies;

import org.springframework.stereotype.Component;

@Component
public class SystemOutMessageService implements MessageService {

    @Override
    public void showMessage(String message) {
        System.out.println(message);
    }
}
