package es.garchypielago.dwes.ejemplo03web.repositories.base;

import java.util.Map;
import java.util.HashMap;

public class RepositoryImp<T,ID> implements Repository<T,ID> {

    private Map<ID,T> data = new HashMap<>();

    @Override
    public T findById(ID id){
        return data.get(id);
    }
}
