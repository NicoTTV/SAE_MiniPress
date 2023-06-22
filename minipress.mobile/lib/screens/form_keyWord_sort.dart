import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:provider/provider.dart';

import '../models/article_provider.dart';

class FormKeyWordSort extends StatefulWidget {
  const FormKeyWordSort({Key? key}) : super(key: key);

  @override
  _FormKeyWordSortState createState() => _FormKeyWordSortState();
}

class _FormKeyWordSortState extends State<FormKeyWordSort> {
  final _formKey = GlobalKey<FormState>();
  final keyWordController = TextEditingController();

  @override
  void dispose() {
    // Clean up the controller when the widget is disposed.
    keyWordController.dispose();
    super.dispose();
  }

  @override
  void initState() {
    super.initState();
    keyWordController.text = "";
  }

  @override
  Widget build(BuildContext context) {
    var articleProvider = context.watch<ArticleProvider>();
    return Form(
      key: _formKey,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            margin: const EdgeInsets.only(right: 20),
            child: SizedBox(
              width: 300,
              child: TextFormField(
                controller: keyWordController,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return "Veuillez entrer du texte";
                  }
                  return null;
                },
                decoration: const InputDecoration(hintText: 'Titre'),
              ),
            ),
          ),
          ElevatedButton(
            onPressed: () {
              if (_formKey.currentState!.validate()) {
                articleProvider.triParMotCle(keyWordController.text);
              }
            },
            child: const Text('Trier'),
          ),
        ],
      ),
    );
  }
}
